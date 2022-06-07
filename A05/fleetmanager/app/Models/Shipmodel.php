<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Shipmodel extends Model
{
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
        //return $this->hasMany(Manufacturer::class);
    }

    public function ships()
    {
        return $this->hasMany(Ship::class);
    }
}
