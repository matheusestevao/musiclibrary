<?php

use Illuminate\Database\Seeder;
use App\Models\PermissionRole;

class PermissionRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        PermissionRole::create([
        	'permission_id' => '1',
        	'role_id'		=> '1'
        ]);

        PermissionRole::create([
        	'permission_id' => '2',
        	'role_id'		=> '1'
        ]);

        PermissionRole::create([
        	'permission_id' => '3',
        	'role_id'		=> '1'
        ]);

        PermissionRole::create([
        	'permission_id' => '4',
        	'role_id'		=> '1'
        ]);

        PermissionRole::create([
        	'permission_id' => '5',
        	'role_id'		=> '1'
        ]);

        PermissionRole::create([
        	'permission_id' => '6',
        	'role_id'		=> '1'
        ]);

    }
}
