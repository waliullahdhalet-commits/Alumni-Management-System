<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Workshop extends Model
{
    use HaFactory;

    protected $fillable = [
        'created_by',
        'title',
        'description',
        'instructor',
        'mode',
        'venue',
        'meeting_url',
        'start_time',
        'end_time',
        'registeration_deadline',
        'image',
        'status'
    ];
}
