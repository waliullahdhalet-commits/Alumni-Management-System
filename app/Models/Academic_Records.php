<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic_Records extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_profile_id',
        'degree',
        'department',
        'institution',
        'start_year',
        'end_year',
        'grade',
        'cgpa',
        'description'

    ];
}
