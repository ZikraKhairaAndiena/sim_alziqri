<?php

namespace App\Http\Controllers;

use App\Helpers\FonnteHelper;
use App\Models\FonnteLog;
use App\Models\Ppdb;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AdminPpdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PPDB::with(['user', 'thn_ajaran', 'siswa'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', function($q) use ($search) {
                $q->where('nama_siswa', 'like', "%{$search}%");
            });
        }

        $ppdbs = $query->paginate(10);
        $ppdbs->appends($request->only('search')); // biar query search tetap ada di pagination
        //$ppdbs = PPDB::with(['user', 'thn_ajaran'])->latest()->paginate(10);
        return view('admin.ppdb.admin', compact('ppdbs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ppdb = Ppdb::with(['user', 'thn_ajaran'])->findOrFail($id);
        $siswa = Siswa::where('user_id', $ppdb->user_id)->first();

        return view('admin.ppdb.show', compact('ppdb', 'siswa'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak',
        ]);

        $ppdb = PPDB::findOrFail($id);
        $ppdb->status = $request->status;
        $ppdb->save();

        $siswa = Siswa::find($ppdb->siswa_id);
        if ($siswa) {
            // update status siswa hanya kalau diterima
            if ($request->status === 'Diterima') {
                $siswa->status = 'aktif';
            } else {
                $siswa->status = 'tidak_aktif';
            }
            $siswa->save();

            // Format nomor telepon ke +62
            $nomor = preg_replace('/[^0-9]/', '', $siswa->no_telp);
            if (substr($nomor, 0, 1) === '0') {
                $nomor = '62' . substr($nomor, 1);
            } elseif (substr($nomor, 0, 2) !== '62') {
                $nomor = '62' . $nomor;
            }

            // Buat pesan WA sesuai status
            if ($request->status === 'Diterima') {
                $pesan = "Pendaftaran TK AL-Ziqri atas nama {$siswa->nama_siswa} sudah *DITERIMA*.\n\n"
                    . "Silakan lakukan pembayaran di menu Pembayaran melalui akun masing-masing.";
            } else {
                $pesan = "Mohon maaf, pendaftaran TK Al-Ziqri atas nama {$siswa->nama_siswa} *DITOLAK*.\n\n"
                    . "Untuk informasi lebih lanjut silakan hubungi pihak sekolah.";
            }

            // Kirim pesan WA via Fonnte
            $result = FonnteHelper::kirimPesan($nomor, $pesan);

            // Simpan log pengiriman
            FonnteLog::create([
                'nomor' => $nomor,
                'pesan' => $pesan,
                'response' => json_encode($result, JSON_UNESCAPED_UNICODE)
            ]);
        }

        // if ($request->status === 'Diterima') {
        //     $siswa = Siswa::find($ppdb->siswa_id);
        //     if ($siswa) {
        //         $siswa->status = 'aktif';
        //         $siswa->save();

        //         // Format nomor telepon ke +62
        //         $nomor = preg_replace('/[^0-9]/', '', $siswa->no_telp); // buang semua selain angka
        //         if (substr($nomor, 0, 1) === '0') {
        //             $nomor = '62' . substr($nomor, 1); // ganti 0 awal jadi 62
        //         } elseif (substr($nomor, 0, 2) !== '62') {
        //             $nomor = '62' . $nomor; // pastikan diawali 62
        //         }

        //         // Buat pesan WA
        //         $pesan = "Pendaftaran sekolah atas nama {$siswa->nama_siswa} sudah *DITERIMA*.\n\n"
        //             . "Silakan lakukan pembayaran di menu Pembayaran melalui akun masing-masing.";

        //         // Kirim pesan WA via Fonnte
        //         $result = FonnteHelper::kirimPesan($nomor, $pesan);

        //         // Simpan log pengiriman
        //         FonnteLog::create([
        //             'nomor' => $nomor,
        //             'pesan' => $pesan,
        //             'response' => json_encode($result, JSON_UNESCAPED_UNICODE)
        //         ]);
        //     }
        // }

        return redirect()->route('admin.ppdb.admin')->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

}
