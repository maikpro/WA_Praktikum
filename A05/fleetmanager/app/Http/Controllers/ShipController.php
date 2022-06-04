<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ship;

class ShipController extends Controller
{
    protected $className = 'App\Models\Ship';
    protected $entityName = 'ships';
    protected $fields = ['name', 'description', 'brt'];
    protected $validation = [
        'name' => 'required',
        'description' => 'required',
        'brt' => 'required|numeric'
    ];
    //
}
