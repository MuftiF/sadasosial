<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $table = 'berita_acara';

    protected $fillable = [
        'perizinan_id',
        'petugas_id',
        'tanggal_pemeriksaan',
        'jenis_pemeriksaan',
        'hasil_pemeriksaan',
        'rekomendasi',
        'catatan_tambahan',
        'tanda_tangan',
        'status',
        'checklist_lapangan',
    ];

    protected $casts = [
        'tanda_tangan'       => 'array',
        'checklist_lapangan' => 'array',
        'tanggal_pemeriksaan' => 'date',
    ];

    public function perizinan()
    {
        return $this->belongsTo(Perizinan::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    /**
     * Label untuk jenis pemeriksaan.
     */
    public function getJenisPemeriksaanLabelAttribute(): string
    {
        return match($this->jenis_pemeriksaan) {
            'lapangan' => 'Pemeriksaan Lapangan',
            'dokumen'  => 'Pemeriksaan Dokumen',
            'virtual'  => 'Pemeriksaan Virtual/Online',
            default    => '-',
        };
    }

    /**
     * Label untuk rekomendasi.
     */
    public function getRekomendasiLabelAttribute(): string
    {
        return match($this->rekomendasi) {
            'terbitkan' => 'Rekomendasi Penerbitan Izin',
            'tolak'     => 'Rekomendasi Penolakan',
            'perbaikan' => 'Perlu Perbaikan/Kelengkapan',
            default     => '-',
        };
    }
}
