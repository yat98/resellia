<?php

namespace App\Http\Middleware;

use App\Supports\CartService;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate extends Middleware
{
	protected $cart;
	protected $auth;

	public function __construct(Auth $auth, CartService $cart)
	{
		parent::__construct($auth);
		$this->cart = $cart;
	}

	public function handle($request, Closure $next, ...$guards)
	{
		$this->authenticate($request, $guards);

		if ($request->user()->can('customer-access')) {
			$cookie = $this->cart->merge();

			return $next($request)->withCookie($cookie);
		}

		return $next($request);
	}

	/**
	 * Get the path the user should be redirected to when they are not authenticated.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return null|string
	 */
	protected function redirectTo($request)
	{
		if (!$request->expectsJson()) {
			return route('login');
		}
	}
}
