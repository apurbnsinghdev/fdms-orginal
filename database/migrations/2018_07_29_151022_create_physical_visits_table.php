<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhysicalVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_visits', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('stage')->default(0);
            $table->unsignedMediumInteger('requisition_id');
            $table->unsignedMediumInteger('user_id');
            $table->boolean('status')->default(0);
            
        });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('physical_visits');
    }
}
