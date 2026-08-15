<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RehabilitasiSosial extends Model
{
    use HasFactory;

    protected $table = 'rehabilitasi_sosials';

    protected $fillable = [
        'user_id',
        'kategori',
        'nama_klien',
        'nik',
        'kab_kota',
        'alamat',
        'deskripsi_kasus',
        'dokumen_pendukung',
        'verifikasi_admin',
        'kondisi_sosial',
        'asesmen_kebutuhan',
        'rekomendasi_layanan',
        'perlu_rujukan',
        'nama_uptd_lembaga',
        'status_penerimaan_uptd',
        'catatan_uptd',
        'alternatif_layanan',
        'progress_layanan',
        'status_workflow',
        'catatan_revisi',
    ];

    protected $casts = [
        'verifikasi_admin' => 'array',
        'kondisi_sosial' => 'array',
        'asesmen_kebutuhan' => 'array',
        'rekomendasi_layanan' => 'array',
        'progress_layanan' => 'array',
        'perlu_rujukan' => 'boolean',
    ];

    /**
     * Get the user that reported/registered the case.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get human readable label for the category.
     */
    public function getKategoriLabelAttribute(): string
    {
        return match($this->kategori) {
            'anak' => 'Rehabilitasi Sosial Anak',
            'lansia' => 'Rehabilitasi Sosial Lanjut Usia',
            'disabilitas' => 'Rehabilitasi Sosial Penyandang Disabilitas',
            'tuna_sosial' => 'Penanganan Tuna Sosial & Warga Rentan',
            'kekerasan' => 'Penanganan Korban Kekerasan, TPPO & Migran',
            'napza' => 'Penanganan Korban NAPZA & ODHA',
            default => ucfirst(str_replace('_', ' ', $this->kategori)),
        };
    }
}
