<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDamageApplicationTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('damage_applications', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedMediumInteger('df_problem_id')->unique();
			$table->unsignedMediumInteger('damage_type_id');
			$table->unsignedMediumInteger('depot_id');
			$table->unsignedMediumInteger('item_id');
			$table->unsignedMediumInteger('shop_id');
			$table->string('remarks', 250)->nullable();
			$table->unsignedMediumInteger('stage')->default(1);
			$table->string('status', 15)->default('processing'); //on_hold/processing/approved/completed
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('damage_applications');
	}
}
