<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
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
Route::post('cart', [CartController::class, 'storeProduct'])->name('cart.store');
Route::put('cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::group(['middleware' => 'checkout.have-cart'], function () {
	Route::get('checkout/login', [CheckoutController::class, 'login'])->name('checkout.login');
	Route::post('checkout/login', [CheckoutController::class, 'postLogin'])->name('checkout.post-login');

	Route::group(['middleware' => 'checkout.login-step-done'], function () {
		Route::get('checkout/address', [CheckoutController::class, 'address'])->name('checkout.address');
		Route::post('checkout/address', [CheckoutController::class, 'postAddress'])->name('checkout.post-address');

		Route::group(['middleware' => 'checkout.address-step-done'], function () {
			Route::get('checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
			Route::post('checkout/payment', [CheckoutController::class, 'postPayment'])->name('checkout.post-payment');
		});
	});
});
Route::group(['middleware' => 'checkout.payment-step-done'], function () {
	Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function ($route) {
	$route->group(['middleware' => 'role:admin'], function ($route) {
		$route->resource('categories', CategoriesController::class, ['names' => 'categories'])
			->except(['show']);
		$route->resource('products', ProductsController::class, ['names' => 'products'])
			->except(['show']);
	});
});
