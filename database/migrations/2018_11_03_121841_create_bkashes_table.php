<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBkashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bkashes', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('requisition_id');
            $table->char('transaction_id', 36)->unique();
            $table->char('reference', 36)->unique();
            $table->decimal('receive_amount',7,2);
            $table->string('sender', 11);
            $table->dateTime('trx_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bkashes');
    }
}
