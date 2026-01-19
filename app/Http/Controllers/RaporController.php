<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\KriteriaPenilaian;
use App\Models\NilaiRapor;
use App\Models\Rapor;
use App\Models\Siswa;
use App\Models\ThnAjaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RaporController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rapors = Rapor::with(['siswa' => fn($q) => $q->whereHas('ppdb', fn($qq) => $qq->where('status', 'Diterima')), 'thnAjaran'])
            ->latest()
            ->paginate(10);
        return view('admin.rapor.index', compact('rapors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswas = Siswa::where('status', 'aktif')
            ->whereHas('ppdb', fn($q) => $q->where('status', 'Diterima'))
            ->get();
        $thnAjarans = ThnAjaran::where('status', 'aktif')->first();
        $kriterias  = KriteriaPenilaian::orderBy('id')->get();
        return view('admin.rapor.create', compact('siswas', 'thnAjarans', 'kriterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'thn_ajaran_id' => 'required|exists:thn_ajarans,id',
            'semester' => 'required|in:1,2',
            // 'agama' => 'required|string',
            // 'foto_agama' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            // 'jati_diri' => 'required|string',
            // 'foto_jati_diri' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            // 'literasi' => 'required|string',
            // 'foto_literasi' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            // 'steam' => 'required|string',
            // 'foto_steam' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'penilaian' => 'required|array|min:1',
            'penilaian.*.kriteria_id' => 'required|exists:kriteria_penilaians,id',
            'penilaian.*.deskripsi' => 'nullable|string',
            'penilaian.*.foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // $rapor = new Rapor($request->except(['foto_agama', 'foto_jati_diri', 'foto_literasi', 'foto_steam']));

        // // Upload file foto
        // foreach (['foto_agama', 'foto_jati_diri', 'foto_literasi', 'foto_steam'] as $foto) {
        //     if ($request->hasFile($foto)) {
        //         $file = $request->file($foto);
        //         $filename = time() . "_{$foto}_" . $file->getClientOriginalName();
        //         $file->move(public_path('img/'), $filename);
        //         $rapor->$foto = $filename;
        //     }
        // }

        // $rapor->save();

        // buat rapor
        $rapor = Rapor::create($request->only('siswa_id', 'thn_ajaran_id', 'semester'));

        // ambil array input & file nested
        $penilaianData  = $request->input('penilaian', []);
        $penilaianFiles = $request->file('penilaian', []);

        foreach ($penilaianData as $idx => $row) {
            $foto = null;
            if (isset($penilaianFiles[$idx]['foto'])) {
                $file = $penilaianFiles[$idx]['foto'];
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img'), $filename);
                $foto = $filename;
            }

            NilaiRapor::create([
                'rapor_id'   => $rapor->id,
                'kriteria_id' => $row['kriteria_id'],
                'deskripsi'  => $row['deskripsi'] ?? null,
                'foto'       => $foto,
            ]);
        }

        return redirect()->route('admin.rapor.index')->with('success', 'Rapor berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rapor = Rapor::with('siswa.kelas.guru', 'thnAjaran', 'nilaiRapors.kriteria')->findOrFail($id);

        // ambil kepala sekolah
        $kepsek = Guru::where('jabatan', 'kepala_sekolah')->first();

        // ambil guru kelas dari relasi kelas yang dimiliki siswa
        $guruKelas = $rapor->siswa->kelas->guru ?? null;

        return view('admin.rapor.show', compact('rapor', 'kepsek', 'guruKelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $rapor = Rapor::findOrFail($id);
        $rapor = Rapor::with('nilaiRapors')->findOrFail($id);
        $siswas = Siswa::all();
        $thnAjarans = ThnAjaran::where('status', 'aktif')->first();
        $kriterias  = KriteriaPenilaian::orderBy('id')->get();

        $nilaiByKriteria = $rapor->nilaiRapors->keyBy('kriteria_id');

        return view('admin.rapor.edit', compact('rapor', 'siswas', 'thnAjarans', 'kriterias', 'nilaiByKriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rapor = Rapor::with('nilaiRapors')->findOrFail($id);

        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'thn_ajaran_id' => 'required|exists:thn_ajarans,id',
            'semester' => 'required|in:1,2',
            // 'agama' => 'required|string',
            // 'foto_agama' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            // 'jati_diri' => 'required|string',
            // 'foto_jati_diri' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            // 'literasi' => 'required|string',
            // 'foto_literasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            // 'steam' => 'required|string',
            // 'foto_steam' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'penilaian' => 'required|array|min:1',
            'penilaian.*.kriteria_id' => 'required|exists:kriteria_penilaians,id',
            'penilaian.*.deskripsi' => 'nullable|string',
            'penilaian.*.foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // $data = $request->except(['foto_agama', 'foto_jati_diri', 'foto_literasi', 'foto_steam']);

        // foreach (['foto_agama', 'foto_jati_diri', 'foto_literasi', 'foto_steam'] as $foto) {
        //     if ($request->hasFile($foto)) {
        //         // Hapus file lama jika ada
        //         if ($rapor->$foto && file_exists(public_path('img/' . $rapor->$foto))) {
        //             unlink(public_path('img/' . $rapor->$foto));
        //         }

        //         $file = $request->file($foto);
        //         $filename = time() . "_{$foto}_" . $file->getClientOriginalName();
        //         $file->move(public_path('img'), $filename);
        //         $data[$foto] = $filename;
        //     }
        // }

        // $rapor->update($data);

        $rapor->update($request->only('siswa_id', 'thn_ajaran_id', 'semester'));

        $penilaianData  = $request->input('penilaian', []);
        $penilaianFiles = $request->file('penilaian', []);

        foreach ($penilaianData as $idx => $row) {
            $kriteriaId = $row['kriteria_id'];
            $nilai = NilaiRapor::firstOrNew([
                'rapor_id'    => $rapor->id,
                'kriteria_id' => $kriteriaId,
            ]);

            // handle foto
            if (isset($penilaianFiles[$idx]['foto'])) {
                // hapus foto lama jika ada
                if ($nilai->foto && file_exists(public_path('img/' . $nilai->foto))) {
                    @unlink(public_path('img/' . $nilai->foto));
                }
                $file = $penilaianFiles[$idx]['foto'];
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img'), $filename);
                $nilai->foto = $filename;
            }

            $nilai->deskripsi = $row['deskripsi'] ?? null;
            $nilai->save();
        }

        return redirect()->route('admin.rapor.index')->with('success', 'Rapor berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rapor = Rapor::with('nilaiRapors')->findOrFail($id);

        foreach ($rapor->nilaiRapors as $n) {
            if ($n->foto && file_exists(public_path('img/' . $n->foto))) {
                @unlink(public_path('img/' . $n->foto));
            }
        }

        $rapor->delete();

        return redirect()->route('admin.rapor.index')->with('success', 'Rapor berhasil dihapus');
    }

    public function cetak($id)
    {
        $rapor = Rapor::with(['siswa.kelas', 'thnAjaran', 'nilaiRapors.kriteria'])->findOrFail($id);

        $kepsek = Guru::where('jabatan', 'kepala_sekolah')->first();

        $guruKelas = $rapor->siswa->kelas->guru ?? null;

        $pdf = Pdf::loadView('admin.rapor.cetak', [
            'rapor' => $rapor,
            'kepsek' => $kepsek,
            'guruKelas' => $guruKelas,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('Rapor-' . $rapor->siswa->nama_siswa . '.pdf');
    }

    public function ortu()
    {
        // Ambil siswa berdasarkan user login
        $siswa = \App\Models\Siswa::where('user_id', Auth::id())->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        }

        // Ambil rapor semester 1 & 2
        $rapor_semester_1 = Rapor::with(['siswa.kelas', 'thnAjaran', 'nilaiRapors.kriteria'])
            ->where('siswa_id', $siswa->id)
            ->where('semester', 1)
            ->first();

        $rapor_semester_2 = Rapor::with(['siswa.kelas', 'thnAjaran', 'nilaiRapors.kriteria'])
            ->where('siswa_id', $siswa->id)
            ->where('semester', 2)
            ->first();

        return view('admin.rapor.ortu', [
            'siswa' => $siswa,
            'rapor_semester_1' => $rapor_semester_1,
            'rapor_semester_2' => $rapor_semester_2,
            'tahunAjaran' => optional($rapor_semester_1 ?? $rapor_semester_2)->thnAjaran->nama ?? '-'
        ]);
    }
}
