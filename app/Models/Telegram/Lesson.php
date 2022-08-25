<?php

namespace App\Models\Telegram;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'group_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
