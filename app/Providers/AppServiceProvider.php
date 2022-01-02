<?php

namespace App\Providers;

use App\Http\ViewComposers\CartComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Flash\Flash;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register()
	{
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot()
	{
		Paginator::useBootstrap();

		Flash::levels([
			'success' => 'alert-success',
			'warning' => 'alert-warning',
			'error' => 'alert-error',
		]);

		View::composer('*', CartComposer::class);
	}
}
