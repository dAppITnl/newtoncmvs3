<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_scheduled_maintenance_job', function (Blueprint $table) {
            $table->integer('scheduled_maintenance_job_id')->unsigned()->nullable();
            $table->integer('car_id')->unsigned()->nullable();

            $table->foreign('scheduled_maintenance_job_id')->references('id')->on('cars')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('scheduled_maintenance_jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_scheduled_maintenance_job');
    }
};
