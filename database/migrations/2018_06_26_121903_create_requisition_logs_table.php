<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_logs', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('requisition_id');
            $table->tinyInteger('stage');
            $table->string('action_name',10);
            $table->unsignedMediumInteger('user_id');
            $table->string('comments',150)->nullable();
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
        Schema::dropIfExists('requisition_logs');
    }
}
