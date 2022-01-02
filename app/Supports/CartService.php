<?php

namespace App\Supports;

use App\Models\Product;
use Illuminate\Http\Request;

class CartService
{
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function lists()
	{
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
}
