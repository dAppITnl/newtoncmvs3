<?php
// all migrations..

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
        // camelCasing in some tableNames is removed : seen as one word (more clear in references)

        // Engineer
        Schema::create('engineers', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('email');
          $table->string('telephone');
          $table->timestamps();
        });

        // Customer
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('postcode');
            $table->string('town');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->timestamps();
        });

        // Brand
        Schema::create('brands', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->timestamps();
        });

        // Carmodel
        Schema::create('carmodels', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('brand_id');
          $table->string('name');
          $table->timestamps();
          $table->index('brand_id');

          $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });

        // Car
        Schema::create('cars', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('customer_id');
          $table->unsignedBigInteger('carmodel_id')->nullable();
          $table->string('car_license')->unique;
          $table->timestamps();
          $table->index('customer_id');
          $table->index('carmodel_id');

          $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
          $table->foreign('carmodel_id')->references('id')->on('carmodels')->onDelete('cascade');
        });

        // Timeslot
        Schema::create('timeslots', function (Blueprint $table) {
          $table->id();
          $table->string('time_title');
          $table->dateTime('start_time');
          $table->dateTime('end_time');
          $table->timestamps();
        });

        // MaintenanceJobs
        // The table name is shortened see schedmaintjob
        Schema::create('maintjobs', function (Blueprint $table) {
          $table->id();
          $table->string('reference');
          $table->timestamps();
        });

        // ScheduledMaintenanceJobs
        // The table name is shortened else too long for foreign keys..
        Schema::create('schedmaintjobs', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('car_id')->nullable();
          $table->unsignedBigInteger('engineer_id')->nullable();
          $table->unsignedBigInteger('timeslot_id')->nullable();
          $table->unsignedBigInteger('maintjob_id')->nullable();
          $table->string('task');
          $table->timestamps();
          $table->index('car_id');
          $table->index('engineer_id');
          $table->index('timeslot_id');
          $table->index('maintjob_id');
        });

        // SpareParts
        Schema::create('spareparts', function (Blueprint $table) {
          $table->id();
          $table->string('spare_title');
          $table->decimal('price_exvat',10,2);
          $table->integer('vat_percentage');
          $table->timestamps();
        });

        // M2M: Car - ScheduledMaintenanceJob
        Schema::create('car_schedmaintjob', function (Blueprint $table) {
          $table->unsignedBigInteger('schedmaintjob_id')->nullable();
          $table->unsignedBigInteger('car_id')->nullable();
          $table->index('schedmaintjob_id');
          $table->index('car_id');

          $table->foreign('schedmaintjob_id')->references('id')->on('cars')->onDelete('cascade');
          $table->foreign('car_id')->references('id')->on('schedmaintjobs')->onDelete('cascade');
        });

        // M2M: MaintenanceJob - SparePart
        Schema::create('maintjob_sparepart', function (Blueprint $table) {
          $table->unsignedBigInteger('maintjob_id')->nullable();
          $table->unsignedBigInteger('sparepart_id')->nullable();
          $table->index('maintjob_id');
          $table->index('sparepart_id');

          $table->foreign('maintjob_id')->references('id')->on('spareparts')->onDelete('cascade');
          $table->foreign('sparepart_id')->references('id')->on('maintjobs')->onDelete('cascade');
        });

        // M2M: SparePart - Brand
        Schema::create('sparepart_brand', function (Blueprint $table) {
          $table->unsignedBigInteger('sparepart_id')->nullable();
          $table->unsignedBigInteger('brand_id')->nullable();
          $table->index('sparepart_id');
          $table->index('brand_id');

          $table->foreign('sparepart_id')->references('id')->on('brands')->onDelete('cascade');
          $table->foreign('brand_id')->references('id')->on('spareparts')->onDelete('cascade');
        });

        // SparePart - Carmodel
        Schema::create('sparepart_carmodel', function (Blueprint $table) {
          $table->unsignedBigInteger('sparepart_id')->nullable();
          $table->unsignedBigInteger('carmodel_id')->nullable();
          $table->index('sparepart_id');
          $table->index('carmodel_id');

          $table->foreign('sparepart_id')->references('id')->on('carmodels')->onDelete('cascade');
          $table->foreign('carmodel_id')->references('id')->on('spareparts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations (in reverse order).
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('sparepart_carmodel');
      Schema::dropIfExists('sparepart_brand');
      Schema::dropIfExists('maintjob_sparepart');
      Schema::dropIfExists('car_schedmaintjob');

      Schema::dropIfExists('spareparts');
      Schema::dropIfExists('schedmaintjobs');
      Schema::dropIfExists('maintjobs');
      Schema::dropIfExists('timeslots');
      Schema::dropIfExists('cars');
      Schema::dropIfExists('carmodels');
      Schema::dropIfExists('brands');
      Schema::dropIfExists('customers');
      Schema::dropIfExists('engineers');
  }
};
