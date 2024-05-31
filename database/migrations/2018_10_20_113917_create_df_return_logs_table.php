<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDfReturnLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('df_return_logs', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('df_return_id');
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
        Schema::dropIfExists('df_return_logs');
    }
}
