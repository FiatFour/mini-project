<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/users', function () {
    //     return view('users/index');
    // })->name('users.index');

    // Route::get('/users/create', function () {
    //     return view('users/create');
    // })->name('users.create');
    Route::get('/singout', [LoginController::class, 'logout'])->name('singout');

    // Route::controller(App\Http\Controllers\UserController::class)->group(function () {
    //     Route::get('/users', 'index')->name('users.index');
    //     Route::get('/users/create', 'create')->name('users.create');
    //     Route::post('/users', 'store')->name('users.store');

    //     Route::get('/users/edit/{id}', 'edit')->name('users.edit');
    //     Route::get('/users/view/{id}', 'view')->name('users.view');
    //     Route::put('/users/{id}', 'update')->name('users.update');
    //     Route::delete('/users/{id}', 'destroy')->name('users.delete');
    // });

    //TODO
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::resource('orders', App\Http\Controllers\OrderController::class);
    Route::get('/getProduct',[\App\Http\Controllers\OrderController::class, 'getProduct'])->name('orders.getProduct');
    Route::post('/orders/add-order-detail',[\App\Http\Controllers\OrderController::class, 'addOrderDetail'])->name('orders.addOrderDetail');
    Route::post('/orders/update-order-detail', 'OrderController@updateOrderDetail')->name('orders.updateOrderDetail');


    //Util Select2
    Route::name('util.')->prefix('util')->group(function () {
        Route::get('select2/products', [Controllers\Util\Select2Controller::class, 'getProducts'])->name('select2.products');
        Route::get('select2/users', [Controllers\Util\Select2Controller::class, 'getUsers'])->name('select2.users');
        Route::get('select2/prices', [Controllers\Util\Select2Controller::class, 'getPrices'])->name('select2.prices');
        Route::get('select2/categories', [Controllers\Util\Select2Controller::class, 'getCategories'])->name('select2.categories');
    });
    // Route::controller(App\Http\Controllers\CategoryController::class)->group(function () {
    //     Route::get('/categories', 'index')->name('categories.index');
    //     Route::get('/categories/create', 'create')->name('categories.create');
    //     Route::post('/categories', 'store')->name('categories.store');

    //     Route::get('/categories/edit/{id}', 'edit')->name('categories.edit');
    //     Route::get('/categories/view/{id}', 'view')->name('categories.view');
    //     Route::put('/categories/{id}', 'update')->name('categories.update');
    //     Route::delete('/categories/{id}', 'destroy')->name('categories.delete');
    // });
});
