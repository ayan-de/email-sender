<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class SendEmail extends Model
{
    use HasFactory;

    protected $table = 'send_email';

    protected $fillable = [
        'user_id',
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
