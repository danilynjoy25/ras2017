<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	  {
		$role_admin = new Role();
		$role_admin->name = ‘Administrator’;
		$role_admin->description = ‘Admin user’;
		$role_admin->save();
		
		$role_manager = new Role();
		$role_manager->name = ‘manager’;
		$role_manager->description = ‘Manager user’;
		$role_manager->save();
	  }
	}
