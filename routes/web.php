<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// customers
Route::controller(CustomerController::class)->group(function () {
    // index et show
    Route::get('/clients', 'index')->name('customers.index');
    // create et store
    Route::get('/clients/create', 'create')->name('customers.create');
    Route::post('/clients', 'store')->name('customers.store');
    Route::get('/clients/{customer}', 'show')->name('customers.show');
    // edit et update
    Route::get('/clients/{customer}/edit', 'edit')->name('customers.edit');
    Route::put('/clients/{customer}', 'update')->name('customers.update');
    // delete
    Route::delete('/clients/{customer}', 'destroy')->name('customers.destroy');
});

// orders
Route::controller(OrderController::class)->group(function () {
    // index et show
    Route::get('/commandes', 'index')->name('orders.index');
    // create et store
    Route::get('/commandes/create', 'create')->name('orders.create');
    Route::post('/commandes', 'store')->name('orders.store');
    Route::get('/commandes/{order}', 'show')->name('orders.show');
    // edit et update
    Route::get('/commandes/{order}/edit', 'edit')->name('orders.edit');
    Route::put('/commandes/{order}', 'update')->name('orders.update');
    // delete
    Route::delete('/commandes/{order}', 'destroy')->name('orders.destroy');
});

// services
Route::controller(ServiceController::class)->group(function () {
    // index
    Route::get('/services', 'index')->name('services.index');
    // create et store
    Route::get('/services/create', 'create')->name('services.create');
    Route::post('/services', 'store')->name('services.store');
    // edit et update
    Route::get('/services/{service}/edit', 'edit')->name('services.edit');
    Route::put('/services/{service}', 'update')->name('services.update');
    // delete
    Route::delete('/services/{service}', 'destroy')->name('services.destroy');
});

// items
Route::controller(ItemController::class)->group(function () {
    // index
    Route::get('/vetements', 'index')->name('items.index');
    // create et store
    Route::get('/vetements/create', 'create')->name('items.create');
    Route::post('/vetements', 'store')->name('items.store');
    // edit et update
    Route::get('/vetements/{item}/edit', 'edit')->name('items.edit');
    Route::put('/vetements/{item}', 'update')->name('items.update');
    // delete
    Route::delete('/vetements/{item}', 'destroy')->name('items.destroy');
});

// order payments
Route::controller(OrderPaymentController::class)->group(function () {
    // store
    Route::post('/commandes/{order}/paiements', 'store')->name('orders.payments.store');
});

// payments
Route::controller(PaymentController::class)->group(function () {
    // index
    Route::get('/paiements', 'index')->name('payments.index');
    Route::get('/paiements/{payment}', 'show')->name('payments.show');
});