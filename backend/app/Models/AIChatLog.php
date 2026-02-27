<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIChatLog extends Model
{
    use HasFactory;

    protected $table = 'ai_chat_logs';

    protected $fillable = [
        'user_id',
        'user_question',
        'ai_answer',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
