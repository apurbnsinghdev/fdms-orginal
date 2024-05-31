<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('requisitions', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->unsignedMediumInteger('user_id'); //who created it,depot_id
			$table->unsignedMediumInteger('shop_id'); //outlet_name,proprietor_name,address,mobile_number,market_category,estimated_sales
			$table->unsignedMediumInteger('size_id'); //require df size,monthly_charge
			$table->unsignedMediumInteger('item_id')->nullable();
			$table->string('payment_modes', 15);
			$table->unsignedMediumInteger('receive_amount')->nullable();
			$table->string('other_company_df', 55); //Igloo,No
			$table->boolean('exclusive_outlet')->default(1);
			$table->float('distance_from_dist', 3, 2); //3.5km,1km
			$table->string('visibility_of_df', 30); //front side
			$table->unsignedMediumInteger('stage')->default(1);
			$table->string('stage_status', 15)->default('pending'); //pending/canceled/waiting/approved
			$table->string('status', 15)->default('pending'); //pending/approved

			$table->dateTime('inject_date')->nullable();
			$table->date('month_from')->nullable();
			$table->date('month_to')->nullable();
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
		Schema::dropIfExists('requisitions');
	}
}
