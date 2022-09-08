<?php

namespace Database\Seeders;

use App\Models\Telegram\NotificationInterval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationIntervalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NotificationInterval::create([
            'name' => '15 минут',
            'is_period' => true,
            'time' => '00:15:00',
            'selected' => true,
        ]);

        NotificationInterval::create([
            'name' => '1 час',
            'is_period' => true,
            'time' => '01:00:00',
            'selected' => true,
        ]);

        NotificationInterval::create([
            'name' => '10:00',
            'is_period' => false,
            'time' => '10:00:00',
            'selected' => false,
        ]);
    }
}
