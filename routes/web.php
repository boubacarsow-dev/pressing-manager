<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// customers
Route::controller(CustomerController::class)->group(function(){
// index et shoe
    Route::get('/clients', 'index')->name('customers.index');
     // create  et store
    Route::get('/clients/create','create')->name('customers.create');
    Route::post('/clients','store')->name('customers.store');
    Route::get('clients/{customer}','show')->name('customers.show');
    // edit et update
    Route::get('/clients/{customer}/edit','edit')->name('customers.edit');
    Route::put('/clients/{customer}','update')->name('customers.update');

    // delete
    Route::delete('clients/{customer}','destroy')->name('customers.destroy');
});


// orders
Route::controller(OrderController::class)->group(function(){
    //index
    Route::get('/commandes', 'index')->name('orders.index');
    Route::get('/commandes/create', 'create')->name('orders.create');
    Route::post('commandes', 'store')->name('orders.store');
    Route::get('commandes/{order}', 'show')->name('orders.show');

    // edit update
    Route::get('commandes/{order}/edit', 'edit')->name('orders.edit');
    Route::put('commandes/{order}', 'update')->name('orders.update');

    // delete
    Route::delete('commandes/{order}', 'delete')->name('orders.delete');
});

// services
Route::controller(CustomerController::class)->group(function(){
// index et shoe
    Route::get('/services', 'index')->name('services.index');
     // create  et store
    Route::get('/services/create','create')->name('services.create');
    Route::post('/services','store')->name('services.store');
    Route::get('services/{service}','show')->name('services.show');
    // edit et update
    Route::get('/services/{service}/edit','edit')->name('services.edit');
    Route::put('/services/{service}','update')->name('services.update');

    // delete
    Route::delete('services/{customer}','destroy')->name('services.destroy');
});