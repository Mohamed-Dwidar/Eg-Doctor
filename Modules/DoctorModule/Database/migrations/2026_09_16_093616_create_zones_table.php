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
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('city_id');
            $table->double('zone_latitude')->nullable();
            $table->double('zone_longitude')->nullable();
            $table->tinyInteger('zone_map_zoom')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('zones');
    }
};
