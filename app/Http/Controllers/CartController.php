<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
	public function storeProduct(Request $request)
	{
		$this->validate($request, [
			'product_id' => 'required|exists:products,id',
			'quantity' => 'required|integer|min:1',
		]);

		$product = Product::find($request->get('product_id'));
		$quantity = $request->quantity;

		$cart = json_decode($request->cookie('cart'), true) ?? [];
		if (array_key_exists($product->id, $cart)) {
			$quantity += $cart[$product->id];
		}

		$cart[$product->id] = $quantity;
		Session::flash('product_name', $product->name);

		return redirect()->route('catalogs.index')
			->withCookie(cookie()->forever('cart', json_encode($cart)));
	}
}
