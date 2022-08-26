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

        $all_permission = Permission::all();

        $administration = $all_permission->get('name', 'administration');
        $teach = $all_permission->get('name', 'teach');
        $assistance = $all_permission->get('name', 'change the format of education');
        $base_tools = $all_permission->get('name', 'get basic information');
        $education = $all_permission->get('name', 'education');

        $admin->givePermissionTo($administration);
        $teacher->syncPermissions([$teach, $assistance, $base_tools]);
        $assistant->givePermissionTo($assistance);
        $student->syncPermissions([$base_tools, $education]);
    }
}
