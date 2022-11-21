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
        Schema::create('spare_part_brand', function (Blueprint $table) {
            $table->integer('spare_part_id')->unsigned()->nullable();
            $table->integer('brand_id')->unsigned()->nullable();

            $table->foreign('spare_part_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('spare_parts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spare_part_brand');
    }
};
