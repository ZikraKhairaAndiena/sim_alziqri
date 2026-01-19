<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class PembayaranController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = false; // Ganti true jika sudah live
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'orang_tua') {
            $siswa = Siswa::where('user_id', $user->id)->first();
            if (!$siswa) {
                return back()->with('error', 'Data siswa tidak ditemukan');
            }
            $pembayarans = Pembayaran::where('siswa_id', $siswa->id)->latest()->paginate(10);
            return view('admin.pembayaran.index', compact('pembayarans', 'siswa'));
        }

        // // $pembayarans = Pembayaran::with('siswa')->orderBy('created_at', 'desc')->get();
        // $siswaList = Siswa::with('pembayaran', 'ppdb')
        //     ->whereHas('ppdb', function ($query) {
        //         $query->where('status', 'Diterima');
        //     })
        //     ->orderBy('created_at', 'desc')
        //     ->paginate(10);
        // $totalTagihan = 2000000;
        // // return view('admin.pembayaran.index', compact('pembayarans'));
        // return view('admin.pembayaran.index', compact('siswaList', 'totalTagihan'));

        $query = Siswa::with('pembayaran', 'ppdb')
            ->whereHas('ppdb', function ($q) {
                $q->where('status', 'Diterima');
            });

        //  Filter search berdasarkan nama_siswa
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_siswa', 'like', '%' . $request->search . '%');
        }

        $siswaList = $query->orderBy('created_at', 'desc')->paginate(10);

        $totalTagihan = 2000000;

        return view('admin.pembayaran.index', compact('siswaList', 'totalTagihan'))
            ->with('search', $request->search);
    }

    public function create()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $totalTerbayar = Pembayaran::where('siswa_id', $siswa->id)
            ->where('status_bayar', 'paid')
            ->sum('nominal_bayar');

        $totalTagihan = 2000000; // Rp 2.000.000
        $sisaTagihan = $totalTagihan - $totalTerbayar;

        if ($sisaTagihan <= 0) {
            return back()->with('error', 'Tagihan sudah lunas.');
        }

        return view('admin.pembayaran.create', compact('siswa', 'sisaTagihan', 'totalTagihan', 'totalTerbayar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nominal_bayar' => 'required|numeric|min:10000',
        ]);

        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $totalTagihan = 2000000;
        $totalTerbayar = Pembayaran::where('siswa_id', $siswa->id)
            ->where('status_bayar', 'paid')
            ->sum('nominal_bayar');

        $sisaTagihan = $totalTagihan - $totalTerbayar;

        if ($sisaTagihan <= 0) {
            return back()->with('error', 'Tagihan sudah lunas.');
        }

        if ($request->nominal_bayar > $sisaTagihan) {
            return back()->with('error', 'Nominal bayar melebihi sisa tagihan.');
        }

        $orderId = uniqid('PAY-');

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $request->nominal_bayar,
            ],
            'customer_details' => [
                'first_name' => $siswa->nama,
                'email' => $siswa->user->email,
                'phone' => $siswa->no_telp,
            ],
            'callbacks' => [
                'finish' => route('admin.pembayaran.success')
            ]
        ];

        $snapToken = Snap::getSnapToken($params);
        $paymentUrl = "https://app.sandbox.midtrans.com/snap/v2/vtweb/" . $snapToken;

        Pembayaran::create([
            'order_id' => $orderId,
            'siswa_id' => $siswa->id,
            'tgl_bayar' => null,
            'nominal_bayar' => $request->nominal_bayar,
            'status_bayar' => 'pending',
            'link_pembayaran' => $paymentUrl,
        ]);

        return redirect($paymentUrl);
    }

    public function success()
    {
        return view('admin.pembayaran.success');
    }

    public function invoice($id)
    {
        $kepsek = Guru::where('jabatan', 'kepala_sekolah')->first();

        $pembayaran = Pembayaran::with('siswa')->findOrFail($id);

        $totalTagihan = 2000000; // statis

        $totalTerbayar = Pembayaran::where('siswa_id', $pembayaran->siswa_id)
            ->where('status_bayar', 'paid')
            ->where('id', '<=', $id) // hanya pembayaran sampai invoice ini
            ->sum('nominal_bayar');

        $sisaTagihan = max($totalTagihan - $totalTerbayar, 0);

        // Jumlah bayar di invoice ini
        $jumlahBayar = $pembayaran->nominal_bayar;


        // $jumlahBayar = $pembayaran->nominal_bayar;
        // $sisaTagihan = $totalTagihan - $jumlahBayar;
        // $total_dibayar = $jumlahBayar;

        $pdf = Pdf::loadView('admin.pembayaran.invoice', [
            'pembayaran' => $pembayaran,
            'total_tagihan' => $totalTagihan,
            'jumlah_bayar' => $jumlahBayar,
            'sisa_tagihan' => $sisaTagihan,
            'total_dibayar' => $totalTerbayar,
            'kepsek' => $kepsek,
        ]);

        return $pdf->stream('Invoice-' . $pembayaran->id . '.pdf');
    }

    public function riwayat($siswa_id)
    {
        // Ambil data siswa
        $siswa = \App\Models\Siswa::findOrFail($siswa_id);

        // Ambil semua pembayaran siswa ini
        $pembayarans = \App\Models\Pembayaran::where('siswa_id', $siswa_id)
            ->orderBy('tgl_bayar', 'desc')
            ->get();

        // Hitung total terbayar
        $totalTagihan = 2000000; // Bisa juga ambil dari DB jika dinamis
        $totalTerbayar = $pembayarans->where('status_bayar', 'paid')->sum('nominal_bayar');
        $sisaTagihan = max($totalTagihan - $totalTerbayar, 0);
        $persentaseBayar = $totalTagihan > 0 ? round(($totalTerbayar / $totalTagihan) * 100, 2) : 0;

        return view('admin.pembayaran.riwayat', compact(
            'siswa',
            'pembayarans',
            'totalTagihan',
            'totalTerbayar',
            'sisaTagihan',
            'persentaseBayar'
        ));
    }
}
