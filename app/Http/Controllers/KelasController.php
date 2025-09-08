<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\ThnAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelass = Kelas::with(['guru', 'tahunAjaran'])->latest()->paginate(10);
        return view('admin.kelas.index', ['kelass' => $kelass]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gurus = Guru::all();
        $thnAjarans = ThnAjaran::where('status', 'aktif')->first();

        return view('admin.kelas.create', compact('gurus', 'thnAjarans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|string|max:20',
            'thn_ajaran_id' => 'required|exists:thn_ajarans,id',
            'guru_id'       => 'required|exists:gurus,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data kelas
        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'thn_ajaran_id' => $request->thn_ajaran_id,
            'guru_id' => $request->guru_id,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kelas = Kelas::with(['guru', 'tahunAjaran', 'siswas.ppdb'])->findOrFail($id);
        return view('admin.kelas.show', compact('kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $gurus = Guru::all();
        $thnAjarans = ThnAjaran::where('status', 'aktif')->first();
        return view('admin.kelas.edit', compact('kelas', 'gurus', 'thnAjarans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|string|max:20',
            'thn_ajaran_id' => 'required|exists:thn_ajarans,id',
            'guru_id' => 'required|exists:gurus,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'thn_ajaran_id' => $request->thn_ajaran_id,
            'guru_id'       => $request->guru_id,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas deleted successfully!');
    }
}
