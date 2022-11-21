<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    /**
     * Relation 0..* to 0..* Maintjob
     *
     * @return reference to 0.. Maintjob
     */
    public function maintjob()
    {
        return $this->belongsToMany(Maintjob::class, 'maintjob_sparepart');
    }

    /**
     * Relation 0..* to 0..* Brand
     *
     * @return reference to 0.. Brand
     */
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'sparepart_brand');
    }
}
