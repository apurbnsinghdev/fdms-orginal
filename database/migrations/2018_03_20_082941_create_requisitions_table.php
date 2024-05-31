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
			$table->string('type', 10)->default('new_inject');
			$table->string('reference_id', 10)->nullable()->unique();
			$table->unsignedMediumInteger('user_id'); //who created it,depot_id
			$table->unsignedMediumInteger('created_by')->nullable(); //proxy user id
			$table->unsignedMediumInteger('action_by')->nullable(); //who stage action made
			$table->unsignedMediumInteger('shop_id'); //outlet_name,address,mobile_number,market_category,estimated_sales
			$table->unsignedMediumInteger('current_df')->nullable(); //for replace, current df
			$table->unsignedMediumInteger('depot_id')->comment('shop\'s depot_id'); //shop's depot_id
			$table->unsignedMediumInteger('distributor_id')->comment('shop\'s distributor_id'); //shop's distributor_id
			$table->unsignedMediumInteger('size_id'); //require df size,monthly_charge
			$table->unsignedMediumInteger('item_id')->nullable();
			$table->string('payment_modes', 15);
			$table->string('payment_methods', 5)->nullable();
			$table->unsignedMediumInteger('receive_amount')->nullable();
			$table->string('other_company_df', 55)->default('no'); //Igloo,No
			$table->boolean('exclusive_outlet')->default(0);
			$table->float('distance_from_dist', 4, 2); //3.5km,1km
			$table->string('visibility_of_df', 30)->nullable(); //front side
			$table->unsignedMediumInteger('stage')->default(1);
			$table->string('stage_status', 15)->default('pending'); //pending/on_hold/cencelled/approved
			$table->string('status', 15)->default('processing'); //on_hold/processing/cencelled/approved/completed
			$table->timestamps();
			$table->char('doc_verified', 3)->nullable();
			$table->unsignedMediumInteger('doc_verified_by')->nullable();
			$table->char('payment_verified', 3)->nullable();
			$table->unsignedMediumInteger('payment_verrified_by')->nullable();
			$table->boolean('payment_confirm')->default(0);
			$table->unsignedMediumInteger('df_return_id')->nullable();
			$table->unsignedMediumInteger('validate_by')->nullable();
			$table->integer('last_three_months_avg_sales')->nullable();
			$table->integer('last_three_months_avg_sales_real')->nullable();
			$table->integer('average_sales')->nullable();
			$table->integer('average_sales_real')->nullable();
			$table->dateTime('approved_at')->nullable();
			$table->string('comment', 150)->nullable(); //if replace
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
