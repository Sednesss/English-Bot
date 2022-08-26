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
        $administration = Permission::create(['name' => 'administration']);

        $teach = Permission::create(['name' => 'teach']);
        $assistance = Permission::create(['name' => 'change the format of education']);
        $base_tools = Permission::create(['name' => 'get basic information']);

        $education = Permission::create(['name' => 'education']);
    }
}
