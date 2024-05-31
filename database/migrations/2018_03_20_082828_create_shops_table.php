<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('shops', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedMediumInteger('division_id');
            $table->unsignedMediumInteger('district_id');
            $table->unsignedMediumInteger('thana_id');
            $table->unsignedMediumInteger('region_id');
            $table->unsignedMediumInteger('area_id')->nullable();
            $table->unsignedMediumInteger('depot_id');
            $table->string('category', 3)->nullable(); // A, B
            $table->string('outlet_name', 100);
            $table->string('pre_code', 4)->nullable();
            $table->string('code', 8)->nullable()->unique();
            $table->string('previous_outlet_name', 100)->nullable();
            $table->string('proprietor_name', 100);
            $table->string('nid', 17)->nullable();
            $table->string('trade_license', 30)->nullable();
            $table->string('mobile', 11);
            $table->boolean('is_distributor')->default(0);
            $table->unsignedMediumInteger('distributor_id')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('parmanent_address', 255)->nullable();
            $table->string('present_address', 255)->nullable();
            $table->unsignedInteger('estimated_sales')->nullable();
            $table->string('status', 10)->default('active');
            $table->timestamps();
            $table->unique(['outlet_name', 'mobile']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('shops');
    }
}
