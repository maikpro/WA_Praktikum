<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ship;

class ShipController extends Controller
{
    // BRT => (BruttoRegisterTonne - nutzbarer Rauminhalt eines Schiffes)
    protected $className = 'App\Models\Ship';
    protected $entityName = 'ships';
    protected $fields = ['name', 'description','shiptype','width','length', 'crew', 'brt'];
    protected $validation = [
        'name' => 'required',
        'description' => 'required',

        'shiptype' => 'required',
        'width' => 'required',
        'length' => 'required',
        'crew' => 'required',

        'brt' => 'required|numeric'
    ];
    //
}
