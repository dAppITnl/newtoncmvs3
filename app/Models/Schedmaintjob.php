<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedmaintjob extends Model
{
    use HasFactory;

    /**
     * Relation 0..* to 1 Engineer
     *
     * @return reference to 1 Engineer
     */
    public function engineer()
    {
        return $this->belongsTo('App\Models\Engineer');
    }

    /**
     * Relation 0..* to 1 Timeslot
     *
     * @return reference to 1 Timeslot
     */
    public function timeslots()
    {
        return $this->belongsTo('App\Models\Timeslot');
    }

    /**
     * Relation 0..* to 0..* Car via Many-Many table
     *
     * @return reference to 0.. Car
     */
    public function car()
    {
        return $this->belongsToMany(Car::class, 'car_schedmaintjob');
    }

    /**
     * Relation 0..* to 1 Maintjob
     *
     * @return reference to 1 Maintjob
     */
    public function maintjob()
    {
        return $this->belongsTo('App\Models\Maintjob');
    }
}
