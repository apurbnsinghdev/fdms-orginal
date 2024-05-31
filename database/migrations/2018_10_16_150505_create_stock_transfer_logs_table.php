<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTransferLogsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('stock_transfer_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock_transfer_id');
            $table->integer('stock_transfer_detail_id');
            $table->unsignedMediumInteger('item_id');
            $table->timestamps();

            $table->index('stock_transfer_id');
            $table->index('stock_transfer_detail_id');
            $table->index('item_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('stock_transfer_logs');
    }
}
