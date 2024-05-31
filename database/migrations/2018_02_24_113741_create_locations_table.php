<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('locations', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->string('name', 50);
			$table->integer('parent_id')->nullable();
			$table->unsignedTinyInteger('level')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('locations');
	}
}
