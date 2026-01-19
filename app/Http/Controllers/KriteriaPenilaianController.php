<?php

namespace App\Http\Controllers;

use App\Models\KriteriaPenilaian;
use Illuminate\Http\Request;

class KriteriaPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriterias = KriteriaPenilaian::orderBy('id')->paginate(10);
        return view('admin.kriteria.index', compact('kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['nama_kriteria' => 'required|string|max:100|unique:kriteria_penilaians,nama_kriteria']);
        KriteriaPenilaian::create($request->only('nama_kriteria'));
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kriteria = KriteriaPenilaian::findOrFail($id);
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kriteria = KriteriaPenilaian::findOrFail($id);
        $request->validate(['nama_kriteria' => 'required|string|max:100|unique:kriteria_penilaians,nama_kriteria,' . $kriteria->id]);
        $kriteria->update($request->only('nama_kriteria'));
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        KriteriaPenilaian::findOrFail($id)->delete();
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria dihapus');
    }
}
