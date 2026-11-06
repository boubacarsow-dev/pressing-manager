<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// customers
Route::controller(CustomerController::class)->group(function(){
// index et shoe
    Route::get('/clients', 'index')->name('customers.index');
    Route::get('clients/{customer}','show')->name('customers.show');
    // create  et store
    Route::get('/clients/create','create')->name('customers.create');
    Route::post('/clients','store')->name('customers.store');
    // edit et update
    Route::get('/clients/{customer}/edit','edit')->name('customers.edit');
    Route::put('/clients/{customer}','update')->name('customers.update');
});