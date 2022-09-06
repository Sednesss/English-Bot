<?php

namespace Database\Seeders;

use App\Models\Telegram\Group;
use App\Models\Telegram\GroupUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create(['name' => 'KI19-14B']);
        Group::create(['name' => 'BMV20-01B']);

        //Group_Users
        GroupUser::create([
            'user_id' => 1,
            'group_id' => 1,
        ]);

        GroupUser::create([
            'user_id' => 2,
            'group_id' => 1,
        ]);

        GroupUser::create([
            'user_id' => 3,
            'group_id' => 1,
        ]);
    }
}
