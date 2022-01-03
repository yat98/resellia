<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', [CatalogsController::class, 'index']);
Route::get('catalogs', [CatalogsController::class, 'index'])
	->name('catalogs.index');
Route::get('cart', [CartController::class, 'show'])->name('cart.show');
Route::put('cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('home', [HomeController::class, 'index'])->name('home');
Route::post('cart', [CartController::class, 'storeProduct'])->name('cart');

Route::group(['middleware' => 'auth'], function ($route) {
	$route->group(['middleware' => 'role:admin'], function ($route) {
		$route->resource('categories', CategoriesController::class, ['names' => 'categories'])
			->except(['show']);
		$route->resource('products', ProductsController::class, ['names' => 'products'])
			->except(['show']);
	});
});
