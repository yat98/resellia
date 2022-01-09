<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckoutLoginStepDone
{
	/**
	 * Handle an incoming request.
	 *
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		if (auth()->guest() && !session()->has('checkout.email')) {
			return redirect()->route('checkout.login');
		}

		return $next($request);
	}
}
