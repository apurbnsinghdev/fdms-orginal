<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldStocksTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('hold_stocks', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedMediumInteger('depot_id');
			$table->unsignedMediumInteger('brand_id');
			$table->unsignedMediumInteger('size_id');
			$table->integer('qty');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('hold_stocks');
	}
}
