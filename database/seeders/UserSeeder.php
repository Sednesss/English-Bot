<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_1 = User::create(
            [
                'name' => 'Pavel',
                'email' => 'pavel@mail.ru',
                'password' => '1234',
                'tg_username' => 'truqan',
            ]
        );

        $user_2 = User::create(
            [
                'name' => 'Uriy',
                'email' => 'uriy@mail.ru',
                'password' => '1234',
                'tg_username' => 'Bakhtin_Yuriy',
            ]
        );

        $all_permission = Role::all();
        $user_1->assignRole('admin');
        $user_2->assignRole('admin');

    }
}
