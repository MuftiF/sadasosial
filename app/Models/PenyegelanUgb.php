<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyegelanUgb extends Model
{
    use HasFactory;

    protected $table = 'penyegelan_ugb';

    protected $fillable = [
        'perizinan_id',
        'petugas_id',
        'tanggal_penyegelan',
        'saksi',
        'nomor_surat_tugas',
        'petugas_penyegelan',
        'checklist_data',
        'foto_segel',
        'hasil_uji_coba',
        'daftar_pemenang',
        'catatan',
        'status',
    ];

    protected $casts = [
        'saksi'             => 'array',
        'petugas_penyegelan'=> 'array',
        'checklist_data'    => 'array',
        'daftar_pemenang'   => 'array',
        'tanggal_penyegelan'=> 'date',
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
     * Hitung persentase progress checklist.
     */
    public function getProgressAttribute(): int
    {
        $steps = [
            'verif_izin', 'saksi_hadir', 'alat_dicek',
            'uji_coba_selesai', 'segel_terpasang', 'tatib_dibaca', 'undian_selesai',
        ];
        $checklist = $this->checklist_data ?? [];
        $done = collect($steps)->filter(fn($s) => !empty($checklist[$s]))->count();
        return $done > 0 ? (int) round(($done / count($steps)) * 100) : 0;
    }
}
