<?php

namespace App\Supports;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CartService
{
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function lists()
	{
		if (Auth::user()) {
			return Cart::where('user_id', Auth::user()->id)
				->pluck('quantity', 'product_id');
		}

		return json_decode($this->request->cookie('cart'), true) ?? [];
	}

	public function totalProduct()
	{
		return count($this->lists());
	}

	public function isEmpty()
	{
		return $this->totalProduct() < 1;
	}

	public function totalQuantity()
	{
		$total = 0;
		if ($this->totalProduct() > 0) {
			foreach ($this->lists() as $id => $quantity) {
				$total += $quantity;
			}
		}

		return $total;
	}

	public function totalPrice()
	{
		$result = 0;
		foreach ($this->details() as $order) {
			$result += $order['subTotal'];
		}

		return $result;
	}

	public function details()
	{
		$result = [];
		if ($this->totalProduct() > 0) {
			foreach ($this->lists() as $id => $quantity) {
				$product = Product::find($id);
				array_push($result, [
					'id' => $id,
					'detail' => $product->toArray(),
					'quantity' => $quantity,
					'subTotal' => $product->price * $quantity,
				]);
			}
		}

		return $result;
	}

	public function find($id)
	{
		foreach ($this->details() as $order) {
			if ($order['id'] == $id) {
				return $order;
			}
		}

		return null;
	}

	public function merge()
	{
		$cartCookie = json_decode($this->request->cookie('cart'), true) ?? [];
		foreach ($cartCookie as $id => $quantity) {
			$cart = Cart::firstOrNew([
				'product_id' => $id,
				'user_id' => $this->request->user()->id,
			]);
			$cart->quantity = $cart->quantity > 0 ? $cart->quantity : $quantity;
			$cart->save();
		}

		return cookie()->forget('cart');
	}

	public function shippingFee()
	{
		$total = 0;
		foreach ($this->lists() as $id => $quantity) {
			$fee = Product::find($id)->getCostTo($this->getDestinationId()) * $quantity;
			$total += $fee;
		}

		return $total;
	}

	public function clearCartCookie()
	{
		return Cookie::forget('cart');
	}

	public function clearCartRecord()
	{
		return Cart::where('user_id', auth()->user()->id)->delete();
	}

	protected function getDestinationId()
	{
		if (Auth::check() && session()->has('checkout.address.address_id')) {
			$address = Address::find(session('checkout.address.address_id'));

			return $address->city_id;
		}

		return session('checkout.address.city_id');
	}
}
