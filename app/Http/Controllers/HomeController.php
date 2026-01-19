<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Informasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $informasi = Informasi::where('type', 'info')
            ->orderByDesc('tanggal')
            ->orderByDesc('created_at')
            ->take(6)
            ->get();

        $guru = Guru::all(); // ambil semua guru dari tabel guru

        return view('umum.home', compact('informasi', 'guru'));
    }
}
