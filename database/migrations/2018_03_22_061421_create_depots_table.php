<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepotsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('depots', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->boolean('has_incharge')->default(0);
			$table->unsignedMediumInteger('user_id')->nullable();
			$table->unsignedMediumInteger('division_id');
			$table->unsignedMediumInteger('district_id');
			$table->unsignedMediumInteger('thana_id');
			$table->unsignedMediumInteger('region_id');
			$table->unsignedMediumInteger('area_id')->nullable();
			$table->string('name', 50)->unique();
			$table->string('code', 2)->nullable()->unique();
			$table->string('address', 250);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('depots');
	}
}
