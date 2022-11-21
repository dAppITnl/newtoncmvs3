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
        Schema::create('maintenance_job_spare_part', function (Blueprint $table) {
            $table->integer('maintenance_job_id')->unsigned()->nullable();
            $table->integer('spare_part_id')->unsigned()->nullable();

            $table->foreign('maintenance_job_id')->references('id')->on('spare_parts')->onDelete('cascade');
            $table->foreign('spare_part_id')->references('id')->on('maintenance_jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_job_spare_part');
    }
};
