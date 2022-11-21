<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * Relation 1 to 1..* Car
     *
     * @return reference to 1..* car
     */
    public function car()
    {
        return $this->hasOne('App\Models\Car');
    }
}
