<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'account_type',
        'nama_lembaga',
        'jenis_lembaga',
        'no_akta',
        'npwp',
        'alamat_lembaga',
        'dokumen_legalitas',
        'validation_status',
        'validation_note',
        'nik',
        'no_kk',
        'kontak',
        'alamat',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if the user is an administrator.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user has a staff role.
     */
    public function isStaff(): bool
    {
        return in_array($this->role, [
            'admin',
            'sekretariat',
            'verifikator',
            'dinsos_wilayah',
            'bidang_pemberdayaan',
            'bidang_linjamsos',
            'kadinas'
        ]);
    }

    public function isSekretariat(): bool
    {
        return $this->role === 'sekretariat';
    }

    public function isVerifikator(): bool
    {
        return $this->role === 'verifikator';
    }

    public function isDinsosWilayah(): bool
    {
        return $this->role === 'dinsos_wilayah';
    }

    public function isBidangPemberdayaan(): bool
    {
        return $this->role === 'bidang_pemberdayaan';
    }

    public function isBidangLinjamsos(): bool
    {
        return $this->role === 'bidang_linjamsos';
    }

    public function isKadinas(): bool
    {
        return $this->role === 'kadinas';
    }

    /**
     * Check if the user account is a lembaga/organisasi account.
     */
    public function isLembaga(): bool
    {
        return $this->account_type === 'lembaga';
    }

    /**
     * Check if the user account is a masyarakat (individual citizen) account.
     */
    public function isMasyarakat(): bool
    {
        return $this->account_type === 'masyarakat';
    }

    /**
     * Check if lembaga validation is pending.
     */
    public function isValidationPending(): bool
    {
        return $this->validation_status === 'pending';
    }

    /**
     * Check if lembaga has been validated.
     */
    public function isValidated(): bool
    {
        return $this->validation_status === 'validated';
    }

    /**
     * Check if lembaga validation was rejected.
     */
    public function isRejected(): bool
    {
        return $this->validation_status === 'rejected';
    }

    /**
     * Get human-readable label for jenis_lembaga.
     */
    public function getJenisLembagaLabelAttribute(): string
    {
        return match($this->jenis_lembaga) {
            'perusahaan'          => 'Perusahaan',
            'lks'                 => 'Lembaga Kesejahteraan Sosial (LKS)',
            'instansi_pemerintah' => 'Instansi Pemerintah',
            'organisasi_sosial'   => 'Organisasi Sosial',
            default               => '-',
        };
    }

    /**
     * Get the perizinans for the user.
     */
    public function perizinans()
    {
        return $this->hasMany(Perizinan::class, 'pemohon_id');
    }

    /**
     * Get the data validation logs for the user.
     */
    public function validationLogs()
    {
        return $this->hasMany(DataValidationLog::class, 'user_id');
    }

    /**
     * Alias for isValidationPending
     */
    public function isPending(): bool
    {
        return $this->isValidationPending();
    }
}
