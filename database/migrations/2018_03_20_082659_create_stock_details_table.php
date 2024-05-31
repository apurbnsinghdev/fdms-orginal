<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockDetailsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('stock_details', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->unsignedMediumInteger('brand_id')->nullable();
			$table->unsignedMediumInteger('size_id');
			$table->unsignedMediumInteger('stock_id');
			$table->unsignedMediumInteger('qty');
			$table->unsignedMediumInteger('receive_qty')->default(0);
			$table->float('unit_price', 8, 2)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('stock_details');
	}
}
