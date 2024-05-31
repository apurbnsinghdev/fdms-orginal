<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('site_settings', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->string('site_title', 100);
			$table->string('site_author', 100);
			$table->string('author_email')->unique();
			$table->string('address', 250)->nullable();
			$table->string('phone', 100)->nullable();
			$table->string('fax', 100)->nullable();
			$table->string('web', 55)->nullable();
			$table->string('logo', 100);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('site_settings');
	}
}
