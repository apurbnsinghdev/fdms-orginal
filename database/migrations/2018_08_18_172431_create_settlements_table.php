<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettlementsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('settlements', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedMediumInteger('item_id');
			$table->unsignedMediumInteger('shop_id');
			$table->unsignedMediumInteger('requisition_id')->nullable()->unique();
			$table->unsignedMediumInteger('receive_amount')->default(0);
			$table->unsignedMediumInteger('installment')->default(0);
			$table->dateTime('inject_date');
			$table->date('month_from')->nullable();
			$table->date('month_to')->nullable();
			$table->date('closed_date')->nullable();
			$table->unsignedMediumInteger('payable_amount')->default(0);
			$table->unsignedMediumInteger('paid_amount')->default(0);
			$table->date('paid_date')->nullable();
			$table->unsignedInteger('damage_application_id')->nullable();
			$table->string('status', 8)->default('continue'); //continue or closed
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('settlements');
	}
}
