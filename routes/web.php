<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BusinessUserController;
use App\Http\Controllers\InventoryCategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetSubCategoryController;
use App\Http\Controllers\AssetHandlingController;

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

// Route::resource('business', BusinessController::class);
Route::resource('business_user', BusinessUserController::class);
Route::resource('inventory_category', InventoryCategoryController::class);
Route::resource('inventory', InventoryController::class);
Route::resource('asset_category', AssetCategoryController::class);
Route::resource('asset_sub_category', AssetSubCategoryController::class);
Route::resource('asset_handling', AssetHandlingController::class);

//business
Route::get('business', [App\Http\Controllers\BusinessController::class, 'index'])->name('business.index');
// Route::get('business/create', [App\Http\Controllers\BusinessController::class, 'create'])->name('business.create');
Route::post('business', [App\Http\Controllers\BusinessController::class, 'store'])->name('business.store');
// Route::get('business/{business}', [App\Http\Controllers\BusinessController::class, 'show'])->name('business.show');
Route::get('business/{business}/edit', [App\Http\Controllers\BusinessController::class, 'edit'])->name('business.edit');
// Route::put('business/{business}', [App\Http\Controllers\BusinessController::class, 'update'])->name('business.update');
Route::delete('business/{business}', [App\Http\Controllers\BusinessController::class, 'destroy'])->name('business.destroy');

