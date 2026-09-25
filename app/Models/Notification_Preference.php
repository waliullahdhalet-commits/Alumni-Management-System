<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Notification_Preference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_notification',
        'event_notification',
        'workshop_notification',
        'announcement_notification',
        'community_notification',
        'card_notification'
    ];

}
