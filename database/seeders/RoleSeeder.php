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
        $administrator = Role::create(['name' => 'administrator']);
        $teacher = Role::create(['name' => 'teacher']);
        $assistant = Role::create(['name' => 'assistant']);
        $student = Role::create(['name' => 'student']);

        $all_permission = Permission::all();

        $CRUD_user = $all_permission->get('name', 'CRUD user');
        $CRUD_group = $all_permission->get('name', 'CRUD group');
        $edit_storage = $all_permission->get('name', 'edit storage');
        $edit_notification_frequency = $all_permission->get('name', 'edit notification frequency');
        $edit_timetable = $all_permission->get('name', 'edit timetable');
        $edit_tutorial = $all_permission->get('name', 'edit tutorial');
        $send_homework = $all_permission->get('name', 'send homework');
        $send_material = $all_permission->get('name', 'send material');
        $get_group_information = $all_permission->get('name', 'get group information');
        $on_off_notifications = $all_permission->get('name', 'on/off notifications');
        $get_timetable = $all_permission->get('name', 'get timetable');
        $get_homework = $all_permission->get('name', 'get homework');
        $get_material = $all_permission->get('name', 'get material');
        $get_tutorial = $all_permission->get('name', 'get tutorial');

        $administrator->syncPermissions([$CRUD_user, $CRUD_group, $edit_storage, $edit_notification_frequency]);
        $teacher->syncPermissions([$edit_timetable, $edit_tutorial, $send_homework, $send_material,
            $get_group_information, $on_off_notifications]);
        $assistant->syncPermissions([$edit_timetable, $edit_tutorial]);
        $student->syncPermissions([$get_group_information, $on_off_notifications, $get_timetable, $get_homework,
            $get_material, $get_tutorial]);
    }
}
