<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;

class ManufacturerController extends Controller
{
    protected $className = 'App\Models\Manufacturer';
    protected $entityName = 'manufacturers';
    protected $fields = ['name', 'founding', 'location'];
    protected $validation = [
        'name' => 'required',
        'founding' => 'required',
        'location' => 'required',
    ];
    //
}
