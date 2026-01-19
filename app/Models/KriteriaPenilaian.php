<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaPenilaian extends Model
{
    use HasFactory;

    protected $table = 'kriteria_penilaians';

    protected $fillable = ['nama_kriteria'];

    public function nilaiRapors()
    {
        return $this->hasMany(NilaiRapor::class, 'kriteria_id');
    }
}
