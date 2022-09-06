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
        Lesson::create([
            'date' => date('Y-m-d'),
            'time' => date('H:i:s', time() + (60 * 2) + (60 * 60 * 7)),
            'group_id' => 1,
        ]);
    }
}
