<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('zones', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->string('name', 50);
			$table->string('code', 2)->nullable()->unique();
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
		Schema::dropIfExists('zones');
	}
}
