<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;


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

    Route::controller(App\Http\Controllers\CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::get('/categories/create', 'create')->name('categories.create');
        Route::post('/categories', 'store')->name('categories.store');

        Route::get('/categories/edit/{id}', 'edit')->name('categories.edit');
        Route::get('/categories/view/{id}', 'view')->name('categories.view');
        Route::put('/categories/{id}', 'update')->name('categories.update');
        Route::delete('/categories/{id}', 'destroy')->name('categories.delete');
    });
});
