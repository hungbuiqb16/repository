<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

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

Route::get('/', [ProductController::class, 'getAll']);




Route::group(['prefix' => 'products'], function() {
	Route::get('/', [ProductController::class, 'index'])->name('product.list');
	Route::get('/getData', [ProductController::class, 'anyData'])->name('product.getData');
    //Route::get('/{id}', [ProductController::class, 'getById'])->name('product.show');
    Route::get('create', [ProductController::class, 'create'])->name('product.create');
    Route::post('create', [ProductController::class, 'store'])->name('product.store');
    Route::delete('delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

});


Route::group(['prefix' => 'categories'], function() {
	Route::get('/', [CategoryController::class, 'index'])->name('category.list');
	Route::get('create', [CategoryController::class, 'create'])->name('category.create');
	Route::post('create', [CategoryController::class, 'store'])->name('category.store');
});