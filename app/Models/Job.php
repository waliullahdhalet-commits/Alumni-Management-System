<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'posted_by',
        'title',
        'company_name',
        'description',
        'requirements',
        'location',
        'employment_type',
        'salary',
        'deadline',
        'application_email',
        'posted_by',
    ];
}
