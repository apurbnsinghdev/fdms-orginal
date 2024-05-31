<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechniciansTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('technicians', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->unsignedMediumInteger('depot_id');
			$table->string('name', 56);
			$table->string('mobile', 11)->unique();
			$table->string('status', 15)->default('active');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('technicians');
	}
}
