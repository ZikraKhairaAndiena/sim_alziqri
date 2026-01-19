<?php

namespace App\Http\Controllers;

use App\Helpers\FonnteHelper;
use App\Models\FonnteLog;
use App\Models\Pembayaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    /**
     * Callback / Webhook dari Midtrans
     */
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.serverKey');
        $data = $request->all();

        $signatureKey = $data['signature_key'] ?? '';

        // Validasi signature
        $hashed = hash(
            'sha512',
            $data['order_id'] .
                $data['status_code'] .
                $data['gross_amount'] .
                $serverKey
        );

        if ($signatureKey !== $hashed) {
            Log::warning('❌ Signature Midtrans tidak valid', ['data' => $data]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $orderId = $data['order_id'];

        $pembayaran = Pembayaran::where('order_id', $orderId)->first();

        if (!$pembayaran) {
            Log::warning('❌ Pembayaran tidak ditemukan', ['order_id' => $orderId]);
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }

        $transactionStatus = $data['transaction_status'];

        // Update status
        if ($transactionStatus === 'settlement') {
            $pembayaran->status_bayar = 'paid';
            $pembayaran->tgl_bayar = now();
            $pembayaran->save();

            $siswa = $pembayaran->siswa;

            if ($siswa) {
                // Format nomor telepon ke +62
                $nomor = preg_replace('/[^0-9]/', '', $siswa->no_telp);
                if (substr($nomor, 0, 1) === '0') {
                    $nomor = '62' . substr($nomor, 1);
                } elseif (substr($nomor, 0, 2) !== '62') {
                    $nomor = '62' . $nomor;
                }

                // Generate invoice PDF
                $totalTagihan = 2000000; // statis
                $jumlahBayar = $pembayaran->nominal_bayar;
                $sisaTagihan = $totalTagihan - $jumlahBayar;
                $total_dibayar = $jumlahBayar;

                $pdf = Pdf::loadView('admin.pembayaran.invoice', [
                    'pembayaran'    => $pembayaran,
                    'total_tagihan' => $totalTagihan,
                    'jumlah_bayar'  => $jumlahBayar,
                    'sisa_tagihan'  => $sisaTagihan,
                    'total_dibayar' => $total_dibayar,
                ]);

                $pdfPath = storage_path("app/public/invoice-{$pembayaran->id}.pdf");
                $pdf->save($pdfPath);

                // Buat pesan
                $pesan = "Terima kasih telah melakukan pembayaran uang sekolah atas nama *{$siswa->nama_siswa}* sebesar *Rp "
                    . number_format($pembayaran->nominal_bayar, 0, ',', '.')
                    . "* telah kami terima.\n\n"
                    . "TTD: Manajemen TK Al-Ziqri";

                // Kirim pesan via WA (pakai FonnteHelper)
                $result = FonnteHelper::kirimPesan($nomor, $pesan);

                // Simpan log WA
                FonnteLog::create([
                    'nomor' => $nomor,
                    'pesan' => $pesan,
                    'response' => json_encode($result, JSON_UNESCAPED_UNICODE)
                ]);
            }
        } elseif ($transactionStatus === 'pending') {
            $pembayaran->status_bayar = 'pending';
        } elseif (in_array($transactionStatus, ['expire', 'cancel', 'deny'])) {
            $pembayaran->status_bayar = match ($transactionStatus) {
                'expire' => 'expired',
                'cancel' => 'cancelled',
                'deny'   => 'denied',
            };
        } elseif ($transactionStatus === 'capture') {
            if (($data['payment_type'] ?? '') === 'credit_card') {
                if (($data['fraud_status'] ?? '') === 'challenge') {
                    $pembayaran->status_bayar = 'pending';
                } else {
                    $pembayaran->status_bayar = 'paid';
                    $pembayaran->tgl_bayar = now();
                }
            }
        }

        $pembayaran->save();

        Log::info('✅ Midtrans webhook diproses', [
            'order_id' => $orderId,
            'status' => $pembayaran->status_bayar,
            'transaction_status' => $transactionStatus,
        ]);

        return response()->json(['message' => 'Success']);
    }
}
