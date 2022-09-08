<?php

namespace Database\Seeders;

use App\Models\Telegram\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Asia/Krasnoyarsk');

        Lesson::create([
            'date' => date('Y-m-d', time() - 60 * 10),
            'time' => date('H:i:s', time() - 60 * 10),
            'group_id' => 1,
        ]);
        Lesson::create([
            'date' => date('Y-m-d', time() + 60 * 15),
            'time' => date('H:i:s', time() + 60 * 15),
            'group_id' => 1,
        ]);
        Lesson::create([
            'date' => date('Y-m-d', time() + 60 * 20),
            'time' => date('H:i:s', time() + 60 * 20),
            'group_id' => 1,
        ]);
        Lesson::create([
            'date' => date('Y-m-d', time() + 60 * 60),
            'time' => date('H:i:s', time() + 60 * 60),
            'group_id' => 1,
        ]);
        Lesson::create([
            'date' => date('Y-m-d', time() + 60 * 60 * 3),
            'time' => date('H:i:s', time() + 60 * 60 * 3),
            'group_id' => 1,
        ]);


        Lesson::create([
            'date' => date('Y-m-d', time() + 60 * 16),
            'time' => date('H:i:s', time() + 60 * 16),
            'group_id' => 2,
        ]);
        Lesson::create([
            'date' => date('Y-m-d'),
            'time' => date('H:i:s', time() + 60 * 23),
            'group_id' => 2,
        ]);
        Lesson::create([
            'date' => date('Y-m-d'),
            'time' => date('H:i:s', time() + 60 * 65),
            'group_id' => 2,
        ]);
    }
}