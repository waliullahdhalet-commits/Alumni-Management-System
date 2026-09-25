<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni_Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
        'first_name',
        'last_name',
        'phone',
        'gender',
        'date_of_birth',
        'profile_picture',
        'address',
        'city',
        'country',
        'linkedin',
        'about',
        'admission_year',
        'graduation_year',
        'cgpa',
        'current_status',
        'current_company',
        'current_designation',
    ];
}
