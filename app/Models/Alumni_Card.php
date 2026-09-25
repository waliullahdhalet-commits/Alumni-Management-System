<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni_Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumni_profile_id',
        'issued_by',
        'card_number',
        'issue_date',
        'expiry_date',
        'status',
        'qr_code',
    ];
}
