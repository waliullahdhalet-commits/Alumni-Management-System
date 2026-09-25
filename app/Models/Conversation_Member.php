<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation_Member extends Model
{
    use HasFactory;
    protected $fillable = [
        'conversation_id',
        'user_id',
        'joined_at',
        'left_at',
    ];
}
