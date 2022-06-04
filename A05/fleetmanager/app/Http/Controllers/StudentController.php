<?php

namespace App\Http\Controllers;


use App\Models\Book;

class StudentController extends Controller
{   
    protected $className = 'App\Models\Student';
    protected $entityName = 'students';
    protected $fields = ['name', 'firstname', 'birthday'];
    protected $validation = [
        'name' => 'required',
        'firstname' => 'required',
        'birthday' => 'required'
    ];
    
}
