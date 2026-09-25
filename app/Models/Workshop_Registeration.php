<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Workshop_Registeration extends Model
{
    use HasFactory;

    protected $fillable = [
        'workshop_id',
        'user_id',
        'status'
    ];

}
