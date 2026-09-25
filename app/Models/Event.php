<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'description',
        'event_type',
        'event_mode',
        'venue',
        'meeting_url',
        'start_time',
        'end_time',
        'registeration_deadline',
        'image'
    ];
}
