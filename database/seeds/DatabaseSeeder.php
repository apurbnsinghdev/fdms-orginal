<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//$this->call(SiteSettingTableSeeder::class);
		//$this->call(DesignationTableSeeder::class);
		//$this->call(RoleTableSeeder::class);
		//$this->call(UsersTableSeeder::class);
		$this->call(SmsTableSeeder::class);
	}
}
