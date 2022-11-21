<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engineer extends Model
{
    use HasFactory;

    /**
     * Relation 1 to 0..* Schedmaintjob
     *
     * @return reference to 0..* Schedmaintjob
     */
    public function schedmaintjob()
    {
        return $this->hasOne('App\Models\Engineer');
    }

}
