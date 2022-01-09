<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckoutAddressStepDone
{
	/**
	 * Handle an incoming request.
	 *
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		if (!session()->has('checkout.address')) {
			return redirect()->route('checkout.address');
		}

		return $next($request);
	}
}
