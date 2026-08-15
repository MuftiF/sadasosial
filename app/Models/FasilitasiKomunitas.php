<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasiKomunitas extends Model
{
    use HasFactory;

    protected $table = 'fasilitasi_komunitases';

    protected $fillable = [
        'user_id',
        'nama_komunitas',
        'jenis_kelompok',
        'kab_kota',
        'alamat',
        'usulan_kebutuhan',
        'status_verifikasi_dinsos',
        'catatan_verifikasi_dinsos',
        'rencana_fasilitasi',
        'hasil_monitoring',
        'is_efektif',
        'status_workflow',
        'catatan_revisi',
    ];

    protected $casts = [
        'is_efektif' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
