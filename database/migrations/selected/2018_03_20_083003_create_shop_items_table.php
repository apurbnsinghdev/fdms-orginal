<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopItemsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('shop_items', function (Blueprint $table) {
			$table->mediumIncrements('id');
			//$table->unsignedMediumInteger('shop_id');
			$table->unsignedMediumInteger('requisition_id');
			$table->unsignedMediumInteger('item_id');
			$table->string('payment_mode', 15);
			$table->dateTime('start_date');
			$table->unsignedMediumInteger('tenor');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('shop_items');
	}
}
