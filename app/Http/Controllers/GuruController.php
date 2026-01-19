<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gurus = Guru::latest()->paginate(10);
        return view('admin.guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'guru')->get();
        return view('admin.guru.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nip' => 'required|unique:gurus,nip',
            'nama_guru' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'pend_terakhir' => 'required|string|max:30',
            'tgl_mulai_ngajar' => 'required|date',
            'jabatan' => 'required|in:kepala_sekolah,guru_kelas',

        ]);
        $guru = new Guru($request->all());

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_guru_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $guru->foto = $filename;
        }

        $guru->save();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.show', compact('guru'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $users = User::where('role', 'guru')->get();
        return view('admin.guru.edit', compact('guru', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'user_id'         => 'required|exists:users,id',
            'nip'             => 'required|unique:gurus,nip,' . $guru->id,
            'nama_guru'       => 'required|string|max:100',
            'jenis_kelamin'   => 'required|in:L,P',
            'tgl_lahir'       => 'required|date',
            'alamat'          => 'required|string',
            'no_telp'         => 'required|string|max:15',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tgl_mulai_ngajar' => 'required|date',
            'pend_terakhir'   => 'required|string|max:30',
            'jabatan'         => 'required|in:kepala_sekolah,guru_kelas',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($guru->foto && file_exists(public_path('img/' . $guru->foto))) {
                unlink(public_path('img/' . $guru->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_guru_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $data['foto'] = $filename;
        }

        $guru->update($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);

        if ($guru->foto && file_exists(public_path('img/' . $guru->foto))) {
            unlink(public_path('img/' . $guru->foto));
        }

        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
