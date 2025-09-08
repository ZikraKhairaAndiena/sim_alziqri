<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Tabungan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class TabunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // ADMIN: tampilkan semua tabungan
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'orang_tua') {
            // Hanya tampilkan tabungan anaknya
            $siswa = Siswa::where('user_id', $user->id)->first();
            if (!$siswa) {
                return back()->with('error', 'Data siswa tidak ditemukan');
            }
            $tabungans = Tabungan::where('siswa_id', $siswa->id)->orderByDesc('tanggal')->orderByDesc('id')->get();
            return view('admin.tabungan.ortu', compact('tabungans', 'siswa'));
        }

        $search = request('search');

        $siswaList = Siswa::whereHas('ppdb', function ($query) {
                $query->where('status', 'Diterima');
            })
            ->when($search, function ($query, $search) {
                $query->where('nama_siswa', 'like', "%{$search}%");
            })
        // ->with('tabungans')
        // ->orderByDesc('id')
        // ->get()
        // ->map(function ($siswa) {
        //     $saldo = $siswa->tabungans->last()?->saldo ?? 0;
        //     return [
        //         'id' => $siswa->id,
        //         'nama_siswa' => $siswa->nama_siswa,
        //         'saldo' => $saldo
        //     ];
        // });

        // return view('admin.tabungan.index', compact('siswaList'));
        ->with(['tabungans' => fn($q) => $q->latest()])
        ->orderByDesc('id')
        ->paginate(10)
        ->through(function ($siswa) {
            return [
                'id'         => $siswa->id,
                'nama_siswa' => $siswa->nama_siswa,
                'saldo'      => $siswa->tabungans->first()?->saldo ?? 0,
            ];
        });

        return view('admin.tabungan.index', compact('siswaList'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== 'guru') { // ✅
            abort(403);
        }

        $siswas = Siswa::where('status', 'aktif') // ✅ hanya yg aktif
        ->whereHas('ppdb', fn($q) => $q->where('status','Diterima'))
        ->orderBy('nama_siswa')
        ->get();
        return view('admin.tabungan.create', compact('siswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'guru') { // ✅
            abort(403);
        }

        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'jenis_transaksi' => 'required|in:setor,tarik',
            'jumlah' => 'required|numeric|min:0',
            'ket' => 'required|string',
        ]);

        $lastSaldo = Tabungan::where('siswa_id', $request->siswa_id)->latest()->first();
        $saldoSebelumnya = $lastSaldo ? $lastSaldo->saldo : 0;

        // Validasi khusus untuk tarik
        if ($request->jenis_transaksi === 'tarik' && $request->jumlah > $saldoSebelumnya) {
            return back()->withInput()->withErrors([
                'jumlah' => 'Jumlah penarikan tidak boleh melebihi saldo yang tersedia (' . number_format($saldoSebelumnya, 2) . ').'
            ]);
        }
        // Hitung saldo baru
        $saldoBaru = $request->jenis_transaksi === 'setor'
            ? $saldoSebelumnya + $request->jumlah
            : $saldoSebelumnya - $request->jumlah;

        Tabungan::create([
            'siswa_id' => $request->siswa_id,
            'tanggal' => $request->tanggal,
            'jenis_transaksi' => $request->jenis_transaksi,
            'jumlah' => $request->jumlah,
            'saldo' => $saldoBaru,
            'ket' => $request->ket,
        ]);

        return redirect()->route('admin.tabungan.index')->with('success', 'Data tabungan berhasil disimpan.');
    }

    public function riwayat($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $tabungans = Tabungan::where('siswa_id', $siswa->id)
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.tabungan.riwayat', compact('tabungans', 'siswa'));
    }

    public function exportPdf($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);

        $tabungans = Tabungan::where('siswa_id', $siswa->id)
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        // ambil data kepala sekolah
        $kepsek = Guru::where('jabatan', 'kepala_sekolah')->first();

        $pdf = PDF::loadView('admin.tabungan.cetak', compact('tabungans', 'siswa', 'kepsek'))
            ->setPaper('A4', 'portrait');

        // preview di tab baru
        return $pdf->stream('Riwayat-Tabungan-' . $siswa->nama_siswa . '.pdf');
    }
}
