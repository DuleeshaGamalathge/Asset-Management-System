<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
// use App\Http\Controllers\UserController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/business', [BusinessController::class, 'index']);
// Route::get('/business/create', [App\Http\Controllers\BusinessController::class, 'create_form'])->name('company.business.create.form');
// Route::get('/business/get', [App\Http\Controllers\BusinessController::class, 'store_business'])->name('company.business.get');
// Route::post('/business/create', [App\Http\Controllers\BusinessController::class, 'create'])->name('company.business.create');


Route::resource('business', BusinessController::class);
