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
        'status',
        'catatan',
        'dokumen',
    ];

    public function pemohon()
    {
        return $this->belongsTo(User::class, 'pemohon_id');
    }
}
