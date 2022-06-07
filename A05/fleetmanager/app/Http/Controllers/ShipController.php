<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ship;
use App\Models\Shipmodel;


class ShipController extends Controller
{
    // BRT => (BruttoRegisterTonne - nutzbarer Rauminhalt eines Schiffes)
    protected $className = 'App\Models\Ship';
    protected $entityName = 'ships';
    protected $fields = ['shipmodel_id', 'name', 'description','shiptype','width','length', 'crew', 'brt'];
    protected $validation = [
        'shipmodel_id' => 'required',
        'name' => 'required',
        'description' => 'required',

        'shiptype' => 'required',
        'width' => 'required',
        'length' => 'required',
        'crew' => 'required',

        'brt' => 'required|numeric'
    ];
    //

    public function getAdd()
    {
        $shipmodels = Shipmodel::all()->pluck(
            'name',
            'id'
        );
        return view($this->entityName.'.add')->with('shipmodels', $shipmodels);
    }

    public function getEdit($id)
    {
        $class = $this->className;
        $entity = $class::find($id);
        $shipmodels = Shipmodel::all()->pluck(
            'name',
            'id'
        );
        if ($entity)
        {
            return view($this->entityName.'.edit')->with(compact('entity', 'shipmodels'));
        }
        return redirect($this->entityName.'/index');
    }
}
