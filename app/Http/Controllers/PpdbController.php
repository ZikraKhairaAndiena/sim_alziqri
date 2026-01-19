<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Ppdb;
use App\Models\Siswa;
use App\Models\Thn_ajaran;
use App\Models\ThnAjaran;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PpdbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ppdbs = Ppdb::with('siswa', 'thn_ajaran')
            ->where('user_id', Auth::id())
            ->first();

        return view('admin.ppdb.index', compact('ppdbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ppdbs = Ppdb::where('user_id', Auth::id())->first();
        if ($ppdbs) {
            return redirect()->route('admin.ppdb.index')
                ->with('warning', 'Anda sudah mendaftarkan siswa.');
        }

        $tahunAktif = ThnAjaran::where('status', 'Aktif')->first();

        return view('admin.ppdb.create', compact('tahunAktif'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thn_ajaran_id' => 'required|exists:thn_ajarans,id',
            'nama_siswa' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tmp_lahir' => 'required|string|max:20',
            'tgl_lahir' => 'required|date',
            'agama' => 'required|in:islam,kristen,budha,hindu,kong_hu_cu',
            'suku_bangsa' => 'required|string|max:20',
            'anak_ke' => 'required|integer',
            'jmlh_saudara_kandung' => 'required|integer',
            'alamat' => 'required',
            'tmp_tinggal' => 'required|in:orang_tua,wali,nenek,saudara',
            'no_nik' => 'required|digits:16|unique:siswas,no_nik',
            'no_kk' => 'required|digits:16',
            'no_akte' => 'required|string|max:25|unique:siswas,no_akte',
            'nama_wali' => 'required|string|max:100',
            'no_telp' => 'required|string|max:15',
            //'status' => 'required|in:aktif,tidak_aktif',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_akte' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        // Simpan data siswa
        $siswa = new Siswa($request->all());
        $siswa->user_id = Auth::id();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_siswa_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $siswa->foto = $filename;
        }

        if ($request->hasFile('foto_kk')) {
            $file = $request->file('foto_kk');
            $filename = time() . '_kk_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $siswa->foto_kk = $filename;
        }

        if ($request->hasFile('foto_akte')) {
            $file = $request->file('foto_akte');
            $filename = time() . '_akte_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $siswa->foto_akte = $filename;
        }

        $siswa->save();

        // Ambil tahun ajaran aktif
        $thn_ajaran_id = $request->input('thn_ajaran_id');

        // Simpan data PPDB
        Ppdb::create([
            'user_id' => Auth::id(),
            'siswa_id' => $siswa->id,
            'thn_ajaran_id' => $thn_ajaran_id,
            'tgl_daftar' => now(),
            'status' => 'Diproses',
        ]);

        return redirect()->route('orang_tua.ppdb.index')->with('success', 'Pendaftaran berhasil.');
    }

    public function cetak($id)
    {

        $kepsek = Guru::where('jabatan', 'kepala_sekolah')->first();

        $ppdb = Ppdb::with(['siswa', 'thn_ajaran'])->findOrFail($id);

        $pdf = Pdf::loadView('admin.ppdb.cetak', compact('ppdb', 'kepsek'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('Bukti_Pendaftaran_' . $ppdb->siswa->nama_siswa . '.pdf');
    }
}
