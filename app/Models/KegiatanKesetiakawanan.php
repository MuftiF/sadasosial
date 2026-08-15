<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanKesetiakawanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_kegiatan',
        'judul_kegiatan',
        'tema',
        'lokasi',
        'kab_kota',
        'tanggal_pelaksanaan',
        'target_peserta',
        'narasumber',
        'deskripsi_kegiatan',
        'foto_dokumentasi',
        'laporan_kegiatan',
        'status_workflow',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
        'foto_dokumentasi' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesertas()
    {
        return $this->hasMany(KegiatanPeserta::class, 'kegiatan_id');
    }
}
