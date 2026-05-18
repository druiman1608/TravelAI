<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AIChatLog extends Model
{
    use HasFactory;

    protected $table = 'ai_chat_logs';

    protected $fillable = [
        'user_id',
        'message',
        'response',
        'context_data'
    ];

    protected $casts = [
        'context_data' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}