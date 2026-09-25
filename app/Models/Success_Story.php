<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Success_Story extends Model
{
    use HasFactory;

    protected $fillable =[
        'alumni_profile_id',
        'reviewed_by',
        'title',
        'description',
        'status',
        'rejection_reason',
        'reviewed_at',
        'published_at',
    ];
}
