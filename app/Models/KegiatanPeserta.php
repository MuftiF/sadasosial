<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanPeserta extends Model
{
    use HasFactory;

    protected $fillable = [
        'kegiatan_id',
        'user_id',
        'nama_peserta',
        'instansi_unsur',
        'kontak',
        'status_kehadiran',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(KegiatanKesetiakawanan::class, 'kegiatan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
