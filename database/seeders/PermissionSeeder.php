<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        Permission::create(['name' => 'CRUD user']);
        Permission::create(['name' => 'CRUD group']);
        Permission::create(['name' => 'edit storage']);
        Permission::create(['name' => 'edit notification frequency']);

        //assistant and teacher
        Permission::create(['name' => 'edit timetable']);
        Permission::create(['name' => 'edit tutorial']);

        //teacher
        Permission::create(['name' => 'send homework']);
        Permission::create(['name' => 'send material']);

        //teacher and student
        Permission::create(['name' => 'get group information']);
        Permission::create(['name' => 'on/off notifications']);

        //student
        Permission::create(['name' => 'get timetable']);
        Permission::create(['name' => 'get homework']);
        Permission::create(['name' => 'get material']);
        Permission::create(['name' => 'get tutorial']);
    }
}
