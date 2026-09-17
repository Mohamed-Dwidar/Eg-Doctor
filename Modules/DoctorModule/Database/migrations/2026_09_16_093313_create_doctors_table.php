<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up() {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('degree_id');
            $table->bigInteger('city_id');
            $table->bigInteger('zone_id');
            $table->text('address')->nullable();
            $table->double('address_latitude')->default(26.8206)->nullable();
            $table->double('address_longitude')->default(30.8025)->nullable();
            $table->tinyinteger('address_map_zoom')->default(14)->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('pic')->nullable();
            $table->string('working_time')->nullable();
            $table->string('more_info')->nullable();
            $table->integer('views_number')->default(0);
            $table->string('found_us')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('doctors');
    }
};
