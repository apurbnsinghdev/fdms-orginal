<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllocationDetailsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('allocation_details', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->unsignedMediumInteger('allocation_id');
			$table->unsignedMediumInteger('stock_detail_id');
			$table->unsignedMediumInteger('qty');
			$table->unsignedMediumInteger('receive_qty')->default(0);
			$table->unsignedMediumInteger('damage_qty')->default(0);
			$table->unsignedMediumInteger('missing_qty')->default(0);
			$table->unsignedMediumInteger('excess_qty')->default(0);
			$table->string('comments', 200)->nullable();
			$table->boolean('item_created')->default(0);			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('allocation_details');
	}
}
