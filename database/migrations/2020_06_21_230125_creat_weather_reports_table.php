<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatWeatherReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_reports', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('region');
            $table->string('timezone_id');
            $table->float('lon');
            $table->float('lat');
            $table->string('weather_description');
            $table->integer('temperature');
            $table->integer('humidity');
            $table->integer('wind_speed');
            $table->integer('uv_index');
            $table->integer('wind_degree');
            $table->string('wind_direction');
            $table->integer('visibility');
            $table->bigInteger('sunrise');
            $table->bigInteger('sunset');
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
        Schema::dropIfExists('weather_reports');
    }
}
