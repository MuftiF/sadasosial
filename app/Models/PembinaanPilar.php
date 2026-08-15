<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembinaanPilar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori_pilar',
        'nama_pilar',
        'kab_kota',
        'usulan_pembinaan',
        'program_bimtek',
        'tanggal_bimtek',
        'evaluasi_skor',
        'catatan_evaluasi',
        'perlu_pembinaan_lanjutan',
        'status_workflow',
        'catatan_revisi',
    ];

    protected $casts = [
        'program_bimtek' => 'array',
        'tanggal_bimtek' => 'date',
        'perlu_pembinaan_lanjutan' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
