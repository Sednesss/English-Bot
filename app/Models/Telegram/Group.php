<?php

namespace App\Models\Telegram;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_users', 'user_id', 'group_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

}
