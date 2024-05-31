<?php

use Illuminate\Database\Seeder;

class SiteSettingTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(App\SiteSetting::class, 1)->create();
	}
}
