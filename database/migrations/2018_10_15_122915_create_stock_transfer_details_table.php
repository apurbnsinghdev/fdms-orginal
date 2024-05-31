<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTransferDetailsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('stock_transfer_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock_transfer_id');
            $table->unsignedMediumInteger('brand_id');
            $table->unsignedMediumInteger('size_id');
            $table->unsignedMediumInteger('placed_qty')->default(0);
            $table->unsignedMediumInteger('received_qty')->default(0);
            $table->unsignedMediumInteger('missing_qty')->default(0);
            $table->unsignedMediumInteger('excess_qty')->default(0);
            $table->string('comments', 200)->nullable();
            $table->timestamps();

            $table->index('stock_transfer_id');
            $table->index('brand_id');
            $table->index('size_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('stock_transfer_details');
    }
}
