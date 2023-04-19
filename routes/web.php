<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::name('user.')->prefix('user')->group(function(){
    Route::get('index', [App\Http\Controllers\UserController::class, 'index'])->name('index');
});

Route::get('/', App\Http\Controllers\IndexController::class)->name('index');
Route::get('/catalog/index', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/category/{slug}', [App\Http\Controllers\CatalogController::class, 'category'])->name('catalog.category');
Route::get('/catalog/brand/{slug}', [App\Http\Controllers\CatalogController::class, 'brand'])->name('catalog.brand');
Route::get('/catalog/product/{slug}', [App\Http\Controllers\CatalogController::class, 'product'])->name('catalog.product');
Route::get('/catalog/find', [App\Http\Controllers\CatalogController::class, 'find'])->name('catalog.find');
