<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        $user_3 = User::create(
            [
                'name' => 'test',
                'email' => '@testtest',
                'password' => '1234',
                'tg_username' => 'inosu_ke_1',
            ]
        );
        $user_1->tg_user_id = 542017586;
        $user_1->save();
//        $user_3->tg_user_id = 1218954866;
//        $user_3->save();

        $user_1->assignRole('administrator');
        $user_1->assignRole('teacher');
        $user_1->assignRole('assistant');
        $user_1->assignRole('student');

        $user_2->assignRole('administrator');

        $user_3->assignRole('student');

    }
}
