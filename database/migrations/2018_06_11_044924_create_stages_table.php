<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('stages', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->string('name', 50);
			$table->string('module', 25);
			$table->unsignedMediumInteger('sequence')->default(0);
			$table->unique(array('name', 'module'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('stages');
	}
}
