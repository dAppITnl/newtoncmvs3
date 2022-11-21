<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * Relation 1 to 1..* Carmodel
     *
     * @return reference to 1..* Carmodel
     */
    public function carmodel()
    {
        return $this->hasOne('App\Models\Carmodel');
    }

    /**
     * Relation 0..* to 0..* Sparepart
     *
     * @return reference to 0.. Sparepart
     */
    public function spareparts()
    {
        return $this->belongsToMany(Sparepart::class, 'sparepart_brand');
    }

}
