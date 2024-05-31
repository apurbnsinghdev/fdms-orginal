<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllocationsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('allocations', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->unsignedMediumInteger('stock_id');
			$table->unsignedMediumInteger('depot_id');
			$table->unsignedMediumInteger('no_of_item')->default(0);
			$table->unsignedMediumInteger('total_qty')->default(0);
			$table->string('status', 15);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('allocations');
	}
}
