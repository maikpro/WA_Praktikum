<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipmodel;
use App\Models\Manufacturer;

class ShipmodelController extends Controller
{
    protected $className = 'App\Models\Shipmodel';
    protected $entityName = 'shipmodels';
    protected $fields = ['name', 'manufacturer_id'];
    protected $validation = [
        'name' => 'required',
        'manufacturer_id' => 'required',
    ];
    //

    public function getAdd()
    {
        $manufacturers = Manufacturer::all()->pluck(
            'name',
            'id'
        );
        return view($this->entityName.'.add')->with('manufacturers', $manufacturers);
    }

    public function getEdit($id)
    {
        $class = $this->className;
        $entity = $class::find($id);
        $manufacturers = Manufacturer::all()->pluck(
            'name',
            'id'
        );
        if ($entity)
        {
            return view($this->entityName.'.edit')->with(compact('entity', 'manufacturers'));
        }
        return redirect($this->entityName.'/index');
    }
}
