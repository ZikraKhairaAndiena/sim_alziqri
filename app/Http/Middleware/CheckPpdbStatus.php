<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Ppdb;

class CheckPpdbStatus
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'orang_tua') {
            $siswa = Siswa::where('user_id', Auth::id())->first();
            $ppdb = $siswa ? Ppdb::where('siswa_id', $siswa->id)->first() : null;

            if (!$ppdb || $ppdb->status !== 'Diterima') {
                return redirect()->route('admin.pending');
            }
        }

        return $next($request);
    }
}
