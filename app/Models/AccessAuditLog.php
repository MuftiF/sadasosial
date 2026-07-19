<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessAuditLog extends Model
{
    protected $fillable = [
        'admin_id',
        'target_user_id',
        'action',
        'details',
        'ip_address',
        'user_agent',
    ];

    /**
     * Get the admin who performed the change.
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Get the user whose access details were altered.
     */
    public function targetUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }
}
