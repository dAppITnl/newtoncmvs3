<?php
// Original: CarModel.php but renamed to Carmodel.php => CarModel.php does NOT open in VCS editor :( .
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carmodel extends Model
{
    use HasFactory;

    /**
     * Relation 1 to 0..* Car
     *
     * @return reference to 0..* Car
     */
    public function car()
    {
        return $this->hasOne('App\Models\Car');
    }

    /**
     * Relation 1..* to 1 Brand
     *
     * @return reference to 1 Brand
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }
}
