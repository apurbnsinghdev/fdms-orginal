<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDfProblemsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('df_problems', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('token')->unique();
			$table->char('daily_serial', 3);
			$table->string('df_code', 32);
			$table->unsignedSmallInteger('df_size');
			$table->unsignedMediumInteger('region_id');
			$table->unsignedMediumInteger('depot_id');
			$table->unsignedMediumInteger('distributor_id');
			$table->unsignedMediumInteger('shop_id')->nullable();
			$table->string('outlet_name', 100);
			$table->string('proprietor_name', 100);
			$table->string('mobile', 11);
			$table->string('address', 255)->nullable();
			$table->unsignedMediumInteger('technician_id')->nullable();
			$table->string('work_description', 150)->nullable();
			$table->unsignedTinyInteger('pull')->default(0);
			$table->unsignedTinyInteger('support')->default(0);
			$table->date('delivery_date')->nullable();
			$table->unsignedMediumInteger('item_id')->nullable();
			$table->string('status', 20)->default('pending');
			$table->date('attain_date')->nullable();
			$table->date('done_date')->nullable();
			$table->unsignedMediumInteger('user_id')->comment('Complain By');
			$table->unsignedMediumInteger('teamleader_id')->nullable();
			//$table->unsignedMediumInteger('problem_type_id');
			$table->string('comments', 250)->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('df_problems');
	}
}
