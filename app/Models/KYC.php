<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KYC extends Model
{
    protected $table = 'kycs';

    protected $fillable = [
        'user_id',
        'full_name',
        'date_of_birth',
        'gender',
        'address',
        'document_type',
        'document_scan_copy',
        'status',
        'rejected_reason',
        'verified_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
