<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckoutPaymentStepDone
{
	/**
	 * Handle an incoming request.
	 *
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		if (!session()->has('order')) {
			return redirect()->route('checkout.payment');
		}

		return $next($request);
	}
}
