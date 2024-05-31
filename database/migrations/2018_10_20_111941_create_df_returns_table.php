<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDfReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('df_returns', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('user_id')->comment('Placed By');
            $table->unsignedMediumInteger('shop_id');
            $table->unsignedMediumInteger('depot_id');
            $table->unsignedMediumInteger('current_df')->comment('item id');
            $table->string('return_reason',250)->nullable();
            $table->date('withdrawal_date');
            $table->boolean('is_transfer_to_shop')->default(0);
            $table->unsignedMediumInteger('distributor_id')->nullable();
            $table->unsignedMediumInteger('to_shop')->nullable();
            $table->unsignedMediumInteger('stage')->default(1);
            $table->string('status', 15)->default('processing'); //on_hold/processing/cencelled/approved/completed
            $table->unsignedMediumInteger('action_by')->nullable()->comment('Last Action By');
            $table->boolean('is_requisition_created')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('df_returns');
    }
}
