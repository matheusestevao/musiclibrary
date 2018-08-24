<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	User::create([
        	'name'     => 'Admin System',
        	'email'    => 'admin@admin.com',
        	'password' => bcrypt('123456')
        ]);
        
        User::create([
            'name'     => 'User System',
            'email'    => 'user@admin.com',
            'password' => bcrypt('654321')
        ]);
    }
}
