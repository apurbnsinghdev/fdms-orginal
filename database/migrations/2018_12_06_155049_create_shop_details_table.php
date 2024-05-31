<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopDetailsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('shop_details', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('shop_id');
            $table->date('birthday')->nullable();
            $table->date('business_startday')->nullable();
            $table->string('marital_status', 15)->nullable();
            $table->date('marriage_day')->nullable();
            $table->string('spouse_name', 64)->nullable();
            $table->date('spouse_birthday')->nullable();
            $table->string('father_name', 100)->nullable();
            $table->string('mother_name', 100)->nullable();
            $table->char('son', 2)->nullable();
            $table->char('daughter', 2)->nullable();
            $table->string('tin_number', 255)->nullable();
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->timestamps();
            $table->index('shop_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('shop_details');
    }
}
