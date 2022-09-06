<?php

namespace App\Models\Telegram;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationInterval extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_period',
        'period',
        'fixed_time',
        'selected',
    ];
}
