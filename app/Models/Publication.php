<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_profile_id',
        'title',
        'author',
        'journal',
        'publisher',
        'publication_date',
        'publication_url',
        'description'
    ];
}
