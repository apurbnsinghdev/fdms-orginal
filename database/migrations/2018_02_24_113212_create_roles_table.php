<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('roles', function (Blueprint $table) {
			$table->mediumIncrements('id');
			$table->string('name', 100);
			$table->string('description', 400);
			$table->string('status', 15);
			$table->boolean('is_editable')->default(1);
			$table->boolean('is_deletable')->default(1);
			$table->boolean('can_apply')->default(0);
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('roles');
	}
}
