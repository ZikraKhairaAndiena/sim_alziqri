<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    /** @use HasFactory<\Database\Factories\SiswaFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kelas_id',
        'nisn',
        'nama_siswa',
        'jenis_kelamin',
        'tmp_lahir',
        'tgl_lahir',
        'agama',
        'suku_bangsa',
        'anak_ke',
        'jmlh_saudara_kandung',
        'alamat',
        'tmp_tinggal',
        'no_nik',
        'no_kk',
        'no_akte',
        'nama_wali',
        'no_telp',
        'status',
        'foto',
        'foto_kk',
        'foto_akte',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ppdb()
    {
        return $this->hasOne(Ppdb::class, 'siswa_id');
    }

    public function tabungans()
    {
        return $this->hasMany(Tabungan::class);
    }

    public function kehadirans()
    {
        return $this->hasMany(Kehadiran::class, 'siswa_id');
    }

    public function rapors()
    {
        return $this->hasMany(Rapor::class, 'siswa_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
