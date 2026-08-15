<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembinaanKelembagaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lembaga',
        'jenis_lembaga',
        'nomor_registrasi',
        'kab_kota',
        'alamat_lembaga',
        'dokumen_permohonan',
        'usulan_pembinaan',
        'agenda_pembinaan',
        'tanggal_pembinaan',
        'hasil_pembinaan',
        'catatan_evaluasi',
        'perlu_tindak_lanjut',
        'status_workflow',
        'catatan_revisi',
    ];

    protected $casts = [
        'agenda_pembinaan' => 'array',
        'tanggal_pembinaan' => 'date',
        'perlu_tindak_lanjut' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
