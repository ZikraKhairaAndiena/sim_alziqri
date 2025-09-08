<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    /** @use HasFactory<\Database\Factories\KelasFactory> */
    use HasFactory;

    protected $table = 'kelass';

    protected $fillable = [
        'nama_kelas',
        'thn_ajaran_id',
        'guru_id'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'kelas_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(ThnAjaran::class, 'thn_ajaran_id');
    }
}
