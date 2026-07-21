<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerizinanDokumen extends Model
{
    use HasFactory;

    protected $table = 'perizinan_dokumen';

    protected $fillable = [
        'perizinan_id',
        'jenis_dokumen',
        'nama_dokumen',
        'file_path',
        'status',
        'catatan',
        'uploaded_by',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function perizinan()
    {
        return $this->belongsTo(Perizinan::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Daftar label nama dokumen.
     */
    public static function namaLabel(): array
    {
        return [
            // PUB
            'akta_notaris'              => 'Akta Notaris',
            'sk_kemenkumham'            => 'SK Kemenkumham',
            'surat_domisili'            => 'Scan Surat Domisili Yayasan',
            'stp_stpu'                  => 'Scan STP/STPU',
            'surat_ket_baik_pengurus'   => 'Surat Keterangan Baik Pengurus dari Kepolisian',
            'pernyataan_keabsahan'      => 'Surat Pernyataan Keabsahan Dokumen bermaterai',
            'pernyataan_anti_radikal'   => 'Surat Pernyataan tidak untuk Radikalisme/Terorisme bermaterai',
            'rekomendasi_dinsos_kab'    => 'Rekomendasi Dinas Sosial Kab/Kota',
            // UGB
            'dokumen_proposal'          => 'Proposal Kegiatan',
            'dokumen_hadiah'            => 'Daftar Rincian Hadiah',
            // LKS
            'dokumen_akta'              => 'Akta Notaris & AD/ART LKS',
            'dokumen_domisili'          => 'Surat Domisili Kelurahan LKS',
            // Adopsi
            'dokumen_nikah'             => 'Akta Pernikahan',
            'dokumen_sehat'             => 'Surat Sehat Jasmani & Rohani',
            // Umum
            'dokumen_rekening'          => 'Buku Tabungan / Rekening Lembaga',
        ];
    }
}
