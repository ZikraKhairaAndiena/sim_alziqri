<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $users = User::latest()->paginate(10);
        // return view('admin.pengguna.index', ['users' => $users]);

         $query = User::query();

        // Jika ada pencarian nama
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        $users = $query->latest()->paginate(10);

        return view('admin.pengguna.index', compact('users'))
            ->with('search', $request->search);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:50',
            'email' => 'required|string|email|max:25|unique:users',
            'password' => 'required|string|min:5|confirmed',
            'role' => 'required|string|in:orang_tua,admin,guru',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data pengguna
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.pengguna.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id); // mencari siswa berdasarkan ID
        return view('admin.pengguna.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.pengguna.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:50',
            'email' => 'required|string|email|max:25|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:5|confirmed',
            'role' => 'required|string|in:orang_tua,admin,guru',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Perbarui data pengguna
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.pengguna.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.pengguna.index')->with('success', 'User deleted successfully!');
    }
}
