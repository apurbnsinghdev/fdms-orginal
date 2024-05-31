<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStageDetailsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('stage_details', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->unsignedMediumInteger('stage_id');
			$table->unsignedMediumInteger('designation_id');
			$table->text('actions')->nullable();//would be json field
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('stage_details');
	}
}
