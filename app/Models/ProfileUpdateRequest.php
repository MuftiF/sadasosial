<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfileUpdateRequest extends Model
{
    protected $fillable = [
        'user_id',
        'requested_changes',
        'status',
        'rejection_reason',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'requested_changes' => 'array',
        ];
    }

    /**
     * Get the user that requested the profile update.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
