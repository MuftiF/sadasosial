<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonevPemberdayaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'periode_evaluasi',
        'tahun',
        'kab_kota',
        'total_lks_dibina',
        'total_pilar_dibina',
        'total_komunitas_difasilitasi',
        'total_kegiatan_kesetiakawanan',
        'total_tmp_dikelola',
        'capaian_program',
        'kendala_program',
        'rekomendasi_perbaikan',
        'status_workflow',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
