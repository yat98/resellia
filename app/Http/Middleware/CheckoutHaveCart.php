<?php

namespace App\Http\Middleware;

use App\Supports\CartService;
use Closure;
use Illuminate\Http\Request;

class CheckoutHaveCart
{
	protected $cart;

	public function __construct(CartService $cart)
	{
		$this->cart = $cart;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		if ($this->cart->isEmpty()) {
			return redirect()->route('cart.show');
		}

		return $next($request);
	}
}
