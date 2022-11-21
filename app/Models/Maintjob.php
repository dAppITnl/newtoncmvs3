<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintjob extends Model
{
    use HasFactory;

    /**
     * Relation 1 to 0..* Schedmaintjob
     *
     * @return reference to 0..* Schedmaintjob
     */
    public function schedmaintjob()
    {
        return $this->hasOne('App\Models\Schedmaintjob');
    }

    /**
     * Relation 0..* to 0..* Sparepart
     *
     * @return reference to 0.. Sparepart
     */
    public function spareparts()
    {
        return $this->belongsToMany(Sparepart::class, 'maintjob_sparepart');
    }
}
