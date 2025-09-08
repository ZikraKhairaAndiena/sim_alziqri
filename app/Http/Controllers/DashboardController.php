<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        // default values
        $jumlahSiswa = $jumlahGuru = 0;
        $totalTagihan = $totalTerbayar = $sisaTagihan = $persentaseBayar = 0;
        $namaSiswa = [];
        $kehadiran = [];
        $tahunAjaranLabels = $siswaPerTahun = [];

        if ($role === 'admin') {
            // $jumlahSiswa = Siswa::count();
            $jumlahSiswa = Siswa::where('status', 'aktif')->count();
            $jumlahGuru  = Guru::count();

            $biayaTahunanPerSiswa = 720000 + 1080000 + 200000;

            $siswaList = Siswa::with(['pembayaran' => function($q) {
                $q->where('status_bayar', 'paid');
            }])->where('status', 'aktif')
                ->orderBy('created_at', 'desc') // ambil siswa baru terdaftar
                ->limit(10)
                ->get();

            $dataPembayaran = $siswaList->map(function($siswa) use ($biayaTahunanPerSiswa) {
                $totalBayar = $siswa->pembayaran->sum('nominal_bayar');
                $sisaTagihan = max($biayaTahunanPerSiswa - $totalBayar, 0);
                $persentase = $biayaTahunanPerSiswa > 0
                    ? round(($totalBayar / $biayaTahunanPerSiswa) * 100, 2)
                    : 0;

                return [
                    'nama_siswa' => $siswa->nama_siswa,
                    'sisa_tagihan' => $sisaTagihan,
                    'persentase' => $persentase
                ];
            });

            $ppdbData = DB::table('ppdbs')
                ->join('thn_ajarans', 'ppdbs.thn_ajaran_id', '=', 'thn_ajarans.id')
                ->select('thn_ajarans.nama', DB::raw('COUNT(ppdbs.id) as total_siswa'))
                ->where('ppdbs.status', 'Diterima') // hanya yang diterima
                ->groupBy('ppdbs.thn_ajaran_id','thn_ajarans.nama')
                ->orderBy('thn_ajarans.nama','asc')
                ->get();

            $tahunAjaranLabels = $ppdbData->pluck('nama')->toArray();
            $siswaPerTahun = $ppdbData->pluck('total_siswa')->toArray();

            return view('admin.dashboard', compact(
                'jumlahSiswa','jumlahGuru',
                'dataPembayaran',
                'tahunAjaranLabels','siswaPerTahun'
            ));
        }

        if ($role === 'guru') {
            // $jumlahSiswa = Siswa::count();
            $jumlahSiswa = Siswa::where('status', 'aktif')->count();

            // ambil data pertumbuhan siswa per tahun ajaran (sama dengan admin)
            $ppdbData = DB::table('ppdbs')
                ->join('thn_ajarans', 'ppdbs.thn_ajaran_id', '=', 'thn_ajarans.id')
                ->select('thn_ajarans.nama', DB::raw('COUNT(ppdbs.id) as total_siswa'))
                ->where('ppdbs.status', 'Diterima')
                ->groupBy('ppdbs.thn_ajaran_id','thn_ajarans.nama')
                ->orderBy('thn_ajarans.nama','asc')
                ->get();

            $tahunAjaranLabels = $ppdbData->pluck('nama')->toArray();
            $siswaPerTahun = $ppdbData->pluck('total_siswa')->toArray();

            return view('admin.dashboard', compact(
                'jumlahSiswa',
                'tahunAjaranLabels','siswaPerTahun'
            ));
        }

        return view('admin.dashboard', compact(
            'jumlahSiswa','jumlahGuru',
            'totalTagihan','totalTerbayar','sisaTagihan','persentaseBayar',
            'namaSiswa','kehadiran'
        ));
    }
}
