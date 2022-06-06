<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    public function shipmodels()
    {
        return $this->hasMany(Shipmodel::class);
        //return $this->belongsTo(Shipmodel::class);
    }
}
