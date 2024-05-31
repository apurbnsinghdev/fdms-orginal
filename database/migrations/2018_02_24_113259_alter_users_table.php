<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('users', function (Blueprint $table) {
			$table->unsignedMediumInteger('role_id')->after('id');
			$table->unsignedMediumInteger('designation_id')->after('role_id');
			$table->string('status', 15)->after('remember_token');
			$table->string('mobile', 11)->after('email')->nullable()->unique();
			$table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('users', function ($table) {
			$table->dropForeign(['role_id']);
			//$table->dropForeign('users_role_id_foreign');
			$table->dropColumn(['role_id', 'designation_id', 'status']);
		});
	}
}
