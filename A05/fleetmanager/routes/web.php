<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ShipController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    //return redirect('books');
    return redirect('ships');
});

Route::middleware(['auth'])->group(function () {
    Route::get('ships', [ShipController::class, 'getIndex']);
    Route::get('ships/index', [ShipController::class, 'getIndex']);
    Route::get('ships/show/{id}', [ShipController::class, 'getShow']);
    Route::get('ships/add', [ShipController::class, 'getAdd']);
    Route::post('ships/save', [ShipController::class, 'postSave']);
    Route::get('ships/edit/{id}', [ShipController::class, 'getEdit']);
    Route::post('ships/update/{id}', [ShipController::class, 'postUpdate']);
    Route::get('ships/delete/{id}', [ShipController::class, 'getDelete']);
    Route::get('ships/json', [ShipController::class, 'getJson']);

    Route::get('books', [BookController::class, 'getIndex']);
    Route::get('books/index', [BookController::class, 'getIndex']);
    Route::get('books/show/{id}', [BookController::class, 'getShow']);
    Route::get('books/add', [BookController::class, 'getAdd']);
    Route::post('books/save', [BookController::class, 'postSave']);
    Route::get('books/edit/{id}', [BookController::class, 'getEdit']);
    Route::post('books/update/{id}', [BookController::class, 'postUpdate']);
    Route::get('books/delete/{id}', [BookController::class, 'getDelete']);
    Route::get('books/json', [BookController::class, 'getJson']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
