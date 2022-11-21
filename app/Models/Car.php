<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * Relation 1..* to 1 Customer
     *
     * @return reference to 1 Customer
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    /**
     * Relation 0..* to 1 Carmodel
     *
     * @return reference to optional 1 Carmodel
     */
    public function carmodel()
    {
        return $this->belongsTo('App\Models\Carmodel');
    }

    /**
     * Relation 0..* to 0..* ScheduledMaintenanceJob
     *
     * @return reference to 0.. ScheduledMaintanceJob
     */
    public function schedmaintjobs()
    {
        return $this->belongsToMany(Schedmaintjob::class, 'car_schedmaintjob');
    }
}
