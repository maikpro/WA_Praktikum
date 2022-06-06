<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Models\Shipmodel;

class ManufacturerController extends Controller
{
    protected $className = 'App\Models\Manufacturer';
    protected $entityName = 'manufacturers';
    protected $fields = ['name', 'founding', 'location', 'shipmodel_id', 'shipmodel_name'];
    protected $validation = [
        'name' => 'required',
        'founding' => 'required',
        'location' => 'required',
        'shipmodel_id' => 'required',
        'shipmodel_name' => 'required'
    ];
    //
}
