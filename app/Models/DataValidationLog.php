<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataValidationLog extends Model
{
    protected $fillable = [
        'user_id',
        'source',
        'status',
        'checked_by',
        'notes',
        'raw_response',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'raw_response' => 'array',
        ];
    }

    /**
     * Get the user being validated.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the admin user who checked the validation.
     */
    public function checkedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_by');
    }
}
