<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CatalogController;

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

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'middleware' => ['auth', 'admin'],
], function(){
    Route::get('index', App\Http\Controllers\Admin\IndexController::class)->name('index');

    Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);
});

Route::get('/', IndexController::class)->name('index');
Route::get('/catalog/index', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/category/{slug}', [CatalogController::class, 'category'])->name('catalog.category');
Route::get('/catalog/brand/{slug}', [CatalogController::class, 'brand'])->name('catalog.brand');
Route::get('/catalog/product/{slug}', [CatalogController::class, 'product'])->name('catalog.product');
Route::get('/catalog/find', [CatalogController::class, 'find'])->name('catalog.find');
