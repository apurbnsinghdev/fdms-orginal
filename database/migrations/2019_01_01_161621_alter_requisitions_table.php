<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRequisitionsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('requisitions', function (Blueprint $table) {
			$table->dropColumn('other_company_df');
		});

		Schema::table('requisitions', function (Blueprint $table) {
			$table->json('other_company_df')->after('receive_amount')->nullable();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('requisitions', function (Blueprint $table) {
			$table->dropColumn('other_company_df');

		});

		Schema::table('requisitions', function (Blueprint $table) {
			$table->string('other_company_df', 55)->after('receive_amount')->default('no'); //Igloo,No
		});
	}
}
