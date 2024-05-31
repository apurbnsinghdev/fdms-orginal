<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('stocks', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->unsignedMediumInteger('supplier_id')->nullable();
			$table->string('origin', 100)->nullable();
			$table->string('invoice_no', 32)->unique()->nullable();
			$table->date('invoice_date')->nullable();
			$table->string('lc_no', 32)->unique()->nullable();
			$table->date('lc_date')->nullable();
			$table->unsignedMediumInteger('no_of_type')->default(0);
			$table->unsignedMediumInteger('total_item')->default(0);
			$table->boolean('is_allocated')->default(0)->comment('0=not allocated, 1= allocated, 2= allocation approved');
			$table->string('currency', 15)->nullable();
			$table->boolean('is_opening')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('stocks');
	}
}
