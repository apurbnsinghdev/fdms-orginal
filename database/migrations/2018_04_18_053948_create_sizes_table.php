<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('sizes', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->unsignedSmallInteger('name')->unique();
			$table->unsignedMediumInteger('rent_amount');
			$table->unsignedMediumInteger('installment');
			$table->string('availability', 10)->default('yes'); //if freeze is not available
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('sizes');
	}
}
