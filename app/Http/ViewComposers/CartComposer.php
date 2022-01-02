<?php

namespace App\Http\ViewComposers;

use App\Supports\CartService;
use Illuminate\View\View;

class CartComposer
{
	public function __construct(CartService $cart)
	{
		$this->cart = $cart;
	}

	public function compose(View $view)
	{
		$view->with('cart', $this->cart);
	}
}
