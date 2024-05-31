<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('subject', 50);
            $table->string('message', 260);
            $table->boolean('is_designation_wise')->default(0);
            $table->string('designations',30)->nullable();
            $table->string('action',100)->nullable();
            $table->string('status', 8)->default('inactive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms');
    }
}
