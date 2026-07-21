<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatroliUgb extends Model
{
    use HasFactory;

    protected $table = 'patroli_ugb';

    protected $fillable = [
        'petugas_id',
        'tanggal_rencana',
        'lokasi',
        'pembagian_tugas',
        'nomor_surat_tugas',
        'nama_penyelenggara_temuan',
        'jenis_pelanggaran',
        'bukti_foto_temuan',
        'tanggal_temuan',
        'tanggal_pelaksanaan',
        'checklist_kondisi',
        'catatan_pembinaan',
        'foto_dokumentasi',
        'ringkasan_temuan',
        'tindakan_diambil',
        'rekomendasi',
        'status',
    ];

    protected $casts = [
        'pembagian_tugas'   => 'array',
        'checklist_kondisi' => 'array',
        'foto_dokumentasi'  => 'array',
        'tanggal_rencana'   => 'date',
        'tanggal_pelaksanaan' => 'date',
        'tanggal_temuan'    => 'date',
    ];

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    /**
     * Label untuk status patroli.
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'rencana'     => 'Rencana Patroli',
            'pelaksanaan' => 'Sedang Berlangsung',
            'selesai'     => 'Selesai',
            default       => '-',
        };
    }

    /**
     * Warna badge untuk status.
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'rencana'     => 'bg-blue-100 text-blue-700',
            'pelaksanaan' => 'bg-amber-100 text-amber-700',
            'selesai'     => 'bg-emerald-100 text-emerald-700',
            default       => 'bg-slate-100 text-slate-700',
        };
    }

    /**
     * Label jenis pelanggaran.
     */
    public static function jenisOptions(): array
    {
        return [
            'tidak_berizin'    => 'Penyelenggaraan UGB Tanpa Izin',
            'terlambat_lapor'  => 'Terlambat Melaporkan Pelaksanaan',
            'melebihi_hadiah'  => 'Nilai Hadiah Melebihi Izin',
            'lokasi_beda'      => 'Lokasi Berbeda dari Izin',
            'lainnya'          => 'Pelanggaran Lainnya',
        ];
    }
}
