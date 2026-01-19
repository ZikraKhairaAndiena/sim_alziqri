<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapor extends Model
{
    /** @use HasFactory<\Database\Factories\RaporFactory> */
    use HasFactory;

    protected $table = 'rapors';

    protected $fillable = [
        'siswa_id',
        'thn_ajaran_id',
        'semester',
        // 'agama',
        // 'foto_agama',
        // 'jati_diri',
        // 'foto_jati_diri',
        // 'literasi',
        // 'foto_literasi',
        // 'steam',
        // 'foto_steam'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function thnAjaran()
    {
        return $this->belongsTo(ThnAjaran::class, 'thn_ajaran_id');
    }

    public function nilaiRapors()
    {
        return $this->hasMany(NilaiRapor::class, 'rapor_id')->with('kriteria');
    }
}
