<?php

namespace App\Http\Controllers;

use App\Exports\KehadiranExport;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'orang_tua') {
            $siswa = Siswa::where('user_id', $user->id)->first();

            if (!$siswa) {
                return back()->with('error', 'Data siswa tidak ditemukan');
            }

            $kehadirans = Kehadiran::where('siswa_id', $siswa->id)
                ->orderByDesc('tanggal')
                ->paginate(10);

            // view ortu tidak butuh $kelas
            return view('admin.kehadiran.ortu', compact('kehadirans', 'siswa'));
        }

        // Guru/Admin
        $kelas = Kelas::orderBy('nama_kelas')->get();

        $kehadirans = Kehadiran::with(['kelas', 'siswa' => function($q){
            $q->whereHas('ppdb', fn($query) => $query->where('status','Diterima'));
        }])
        ->select('kelas_id', 'tanggal', DB::raw('MIN(id) as id'))
        ->groupBy('kelas_id', 'tanggal')
        ->orderBy('tanggal', 'desc')
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('admin.kehadiran.index', compact('kehadirans', 'kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (Auth::user()->role !== 'guru') {
            abort(403);
        }

        $kelass = Kelas::whereHas('tahunAjaran', function ($q) {
            $q->where('status', 'aktif');
        })->orderBy('nama_kelas')->get();
        $siswas = [];

        if ($request->filled('kelas_id')) {
            $siswas = Siswa::where('kelas_id', $request->kelas_id)
                ->whereHas('ppdb', fn($q) => $q->where('status','Diterima'))
                ->where('status','aktif')
                ->orderBy('nama_siswa')
                ->get();
        }

        return view('admin.kehadiran.create', compact('kelass', 'siswas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'guru') {
            abort(403);
        }

        $request->validate([
            'kelas_id' => 'required|exists:kelass,id',
            'tanggal'  => 'required|date',
            'status'   => 'required|array',
        ]);

        foreach ($request->status as $siswa_id => $status) {
            Kehadiran::updateOrCreate(
                [
                    'kelas_id' => $request->kelas_id,
                    'siswa_id' => $siswa_id,
                    'tanggal'  => $request->tanggal,
                ],
                [
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('admin.kehadiran.index')
            ->with('success', 'Data kehadiran berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kehadiran = Kehadiran::findOrFail($id);

        // Ambil semua kehadiran siswa di kelas & tanggal yang sama
        $kehadiran_siswa = Kehadiran::where('kelas_id', $kehadiran->kelas_id)
            ->where('tanggal', $kehadiran->tanggal)
            ->with('siswa')
            ->get();

        return view('admin.kehadiran.show', compact('kehadiran', 'kehadiran_siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kehadiran $kehadiran)
    {
        $siswas = Siswa::all();
        return view('admin.kehadiran.edit', compact('kehadiran', 'siswas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kehadiran $kehadiran)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal'  => 'required|date',
            'status'   => 'required|in:hadir,izin,sakit,alpha',
        ]);

        $kehadiran->update($request->all());

        return redirect()->route('admin.kehadiran.index')
            ->with('success', 'Data kehadiran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kehadiran $kehadiran)
    {
        $kehadiran->delete();

        return redirect()->route('admin.kehadiran.index')
            ->with('success', 'Data kehadiran berhasil dihapus.');
    }

    /**
     * Export kehadiran ke Excel.
     */
    public function export(Request $request)
    {
        $kelasId = $request->kelas_id;
        $bulanInput   = $request->bulan; // format: YYYY-MM

        [$tahun, $bulan] = explode('-', $bulanInput);

        return Excel::download(new KehadiranExport($kelasId, $bulan, $tahun), 'kehadiran.xlsx');
    }
}
