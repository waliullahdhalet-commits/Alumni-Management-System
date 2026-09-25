<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Work_Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_profile_id',
        'company_name',
        'designation',
        'job_description',
        'employment_type',
        'location',
        'start_date',
        'end_date',
        'currently_working',

    ];
}
