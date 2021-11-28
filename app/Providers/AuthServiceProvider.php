<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		// 'App\Models\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 */
	public function boot()
	{
		$this->registerPolicies();

		Gate::define('admin-access', function ($user) {
			return 'admin' == $user->role;
		});

		Gate::define('customer-access', function ($user) {
			return 'customer' == $user->role;
		});
	}
}
