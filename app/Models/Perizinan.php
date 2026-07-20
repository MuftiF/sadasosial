<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perizinan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pemohon_id',
        'jenis_layanan',
        'nomor_izin',
        'status',
        'tahap_verifikasi',
        'perlu_perbaikan',
        'catatan_perbaikan',
        'data_tambahan',
        'tanggal_terbit',
        'tanggal_kadaluarsa',
        'qr_code_token',
        'history_status',
        'konfirmasi_wilayah',
        'catatan',
        'dokumen',
        'laporan_status',
        'laporan_submitted_at',
        'laporan_data',
        'laporan_catatan',
    ];

    protected $casts = [
        'data_tambahan' => 'array',
        'history_status' => 'array',
        'perlu_perbaikan' => 'boolean',
        'konfirmasi_wilayah' => 'boolean',
        'tanggal_terbit' => 'date',
        'tanggal_kadaluarsa' => 'date',
        'laporan_data' => 'array',
        'laporan_submitted_at' => 'datetime',
    ];

    public function pemohon()
    {
        return $this->belongsTo(User::class, 'pemohon_id');
    }
}
