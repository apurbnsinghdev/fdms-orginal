<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('items', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->string('serial_no', 32)->unique()->nullable();
			$table->unsignedMediumInteger('stock_detail_id');
			$table->unsignedMediumInteger('brand_id')->nullable();
			$table->unsignedMediumInteger('size_id');
			$table->unsignedMediumInteger('depot_id');
			$table->unsignedMediumInteger('allocation_detail_id');
			$table->string('freeze_status', 15)->nullable();
			$table->string('longevity_period', 15); //7 years
			$table->unsignedMediumInteger('shop_id')->nullable();
			$table->unsignedMediumInteger('requisition_id')->nullable();
			$table->string('item_status', 15)->nullable(); //continue/sended_to_sip/returned/transfered
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('items');
	}
}
