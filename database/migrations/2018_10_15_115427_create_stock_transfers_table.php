<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTransfersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('from_depot');
            $table->unsignedMediumInteger('to_depot');
            $table->unsignedMediumInteger('placed_qty')->default(0);
            $table->string('status', 10)->default('pending');
            $table->mediumInteger('placed_by');
            $table->mediumInteger('canceled_by')->default(0);
            $table->mediumInteger('received_by')->default(0);
            $table->mediumInteger('approved_by')->default(0);
            $table->timestamps();

            $table->index('from_depot');
            $table->index('to_depot');
            $table->index('placed_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('stock_transfers');
    }
}
