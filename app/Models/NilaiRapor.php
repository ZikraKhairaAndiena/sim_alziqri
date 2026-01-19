<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiRapor extends Model
{
    use HasFactory;

    protected $table = 'nilai_rapors';

    protected $fillable = [
        'rapor_id',
        'kriteria_id',
        'deskripsi',
        'foto',
    ];

    public function rapor()
    {
        return $this->belongsTo(Rapor::class, 'rapor_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(KriteriaPenilaian::class, 'kriteria_id');
    }
}
