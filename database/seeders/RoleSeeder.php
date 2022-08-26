<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'administrator']);
        $teacher = Role::create(['name' => 'teacher']);
        $assistant = Role::create(['name' => 'assistant']);
        $student = Role::create(['name' => 'student']);

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

        $all_permission = Permission::all();

        $administration = $all_permission->get('name', 'administration');
        $teach = $all_permission->get('name', 'teach');
        $assistance = $all_permission->get('name', 'change the format of education');
        $base_tools = $all_permission->get('name', 'get basic information');
        $education = $all_permission->get('name', 'education');
//
//        $admin->givePermissionTo($administration);
//        $teacher->syncPermissions([$teach, $assistance, $base_tools]);
//        $assistant->givePermissionTo($assistance);
//        $student->syncPermissions([$base_tools, $education]);
    }
}
