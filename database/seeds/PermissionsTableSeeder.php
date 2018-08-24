<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	Permission::create([
    		'name'  => 'menu',
    		'label' => 'Menu'
    	]);

    	Permission::create([
    		'name'  => 'list',
    		'label' => 'List'
    	]);

    	Permission::create([
    		'name'  => 'add',
    		'label' => 'Add'
    	]);

    	Permission::create([
    		'name'  => 'edit',
    		'label' => 'Edit'
    	]);

    	Permission::create([
    		'name'  => 'view',
    		'label' => 'View'
    	]);

    	Permission::create([
    		'name'  => 'delete',
    		'label' => 'Delete'
    	]);

    }
}
