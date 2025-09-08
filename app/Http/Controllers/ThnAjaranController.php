<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\ThnAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ThnAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thn_ajarans = ThnAjaran::latest()->paginate(10);
        return view('admin.thn_ajaran.index', ['thn_ajarans' => $thn_ajarans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.thn_ajaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:15|unique:thn_ajarans,nama',
            'status' => 'required|string|in:aktif,tidak_aktif',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->status === 'aktif') {
            // Set semua tahun ajaran lain jadi tidak_aktif
            ThnAjaran::where('status', 'aktif')->update(['status' => 'tidak_aktif']);
        }

        // Simpan data pengguna
        ThnAjaran::create([
            'nama' => $request->nama,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.thn_ajaran.index')->with('success', 'Tahun Ajaran created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $thn_ajaran = ThnAjaran::findOrFail($id);
        return view('admin.thn_ajaran.show', compact('thn_ajaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $thn_ajaran = ThnAjaran::findOrFail($id);
        return view('admin.thn_ajaran.edit', compact('thn_ajaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $thn_ajaran = ThnAjaran::findOrFail($id);

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:15|unique:thn_ajarans,nama,' . $id,
            'status' => 'required|string|in:aktif,tidak_aktif',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->status === 'aktif') {
            // Set semua tahun ajaran lain jadi tidak_aktif
            ThnAjaran::where('status', 'aktif')->where('id', '!=', $id)->update(['status' => 'tidak_aktif']);

            Siswa::whereHas('ppdb', function($q) use ($id){
                $q->where('thn_ajaran_id', $id)->where('status', 'Diterima');
            })->update(['status' => 'aktif']);
        } else {
            // Nonaktifkan semua siswa di tahun ajaran ini
            Siswa::whereHas('ppdb', function($q) use ($id){
                $q->where('thn_ajaran_id', $id);
            })->update(['status' => 'tidak_aktif']);
        }

        $thn_ajaran->update([
            'nama' => $request->nama,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.thn_ajaran.index')->with('success', 'Tahun Ajaran updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $thn_ajaran = ThnAjaran::findOrFail($id);
        $thn_ajaran->delete();

        return redirect()->route('admin.thn_ajaran.index')->with('success', 'Tahun Ajaran deleted successfully!');
    }
}
