<?php

namespace App\Http\Controllers;


use App\Models\Book;

class BookController extends Controller
{   
    protected $className = 'App\Models\Book';
    protected $entityName = 'books';
    protected $fields = ['title', 'author', 'year', 'pages'];
    protected $validation = [
        'title' => 'required',
        'author' => 'required',
        'year' => 'required',
        'pages' => 'required'
    ];


    public function blubb()
    {
        
    }
    
}
