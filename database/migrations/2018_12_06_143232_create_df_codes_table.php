<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDfCodesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('df_codes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('brand', 3);
			$table->unsignedSmallInteger('size');
			$table->year('year');
			$table->unsignedMediumInteger('user_id');
			$table->string('status', 6)->default('unused');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('post_code');
			$table->string('serial_no', 32)->unique();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('df_codes');
	}
}
