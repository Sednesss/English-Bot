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
            'name' => 'за 15 минут',
            'is_period' => true,
            'period_min' => 15,
            'selected' => true,
        ]);

        NotificationInterval::create([
            'name' => 'за 1 час',
            'is_period' => true,
            'period_min' => 60,
            'selected' => false,
        ]);

        NotificationInterval::create([
            'name' => 'в 10:00',
            'is_period' => false,
            'fixed_time' => '10:00',
            'selected' => false,
        ]);
    }
}
