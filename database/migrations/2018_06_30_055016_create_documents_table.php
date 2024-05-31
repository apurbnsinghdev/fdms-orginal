<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('documents', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedMediumInteger('shop_id');
			$table->unsignedMediumInteger('data_id')->nullable();
			$table->string('module', 15)->nullable();
			$table->string('field_name', 20)->nullable();
			$table->string('file_name', 56);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('documents');
	}
}
