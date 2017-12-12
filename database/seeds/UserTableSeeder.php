<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$role_admin = Role::where(‘name’, ‘administrator’)->first();
		$role_manager  = Role::where(‘name’, ‘manager’)->first();
		
		$admin = new User();
		$admin->name = ‘Administrator Name’;
		$admin->email = ‘employee@example.com’;
		$admin->password = bcrypt(‘secret’);
		$admin->save();
		$admin->roles()->attach($role_admin);
		
		$manager = new User();
		$manager->name = ‘Manager Name’;
		$manager->email = ‘manager@example.com’;
		$manager->password = bcrypt(‘secret’);
		$manager->save();
		$manager->roles()->attach($role_manager);
    }
}
