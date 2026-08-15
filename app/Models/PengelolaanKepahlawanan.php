<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengelolaanKepahlawanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_agenda',
        'nama_tmp_atau_pahlawan',
        'lokasi_tmp',
        'kab_kota',
        'usulan_kegiatan',
        'agenda_ditentukan',
        'tanggal_pelaksanaan',
        'foto_dokumentasi',
        'laporan_hasil',
        'status_workflow',
        'catatan_revisi',
    ];

    protected $casts = [
        'tanggal_pelaksanaan' => 'date',
        'foto_dokumentasi' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
