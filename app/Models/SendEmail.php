<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SendEmail extends Model
{
    protected $table = 'send_email';

    protected $fillable = [
        'user_email',
        'is_sent',
        'is_retry',
    ];

    protected $casts = [
        'is_sent' => 'boolean',
        'is_retry' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
