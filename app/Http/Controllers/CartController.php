<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Supports\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
	protected $cart;

	public function __construct(CartService $cart)
	{
		$this->cart = $cart;
	}

	public function storeProduct(Request $request)
	{
		$this->validate($request, [
			'product_id' => 'required|exists:products,id',
			'quantity' => 'required|integer|min:1',
		]);
		$product = Product::find($request->get('product_id'));
		$quantity = $request->quantity;

		if (Auth::check()) {
			$cart = Cart::firstOrNew([
				'product_id' => $product->id,
				'user_id' => $request->user()->id,
			]);
			$cart->quantity += $quantity;
			$cart->save();

			return redirect()->route('catalogs.index');
		}

		$cart = json_decode($request->cookie('cart'), true) ?? [];
		if (array_key_exists($product->id, $cart)) {
			$quantity += $cart[$product->id];
		}

		$cart[$product->id] = $quantity;
		Session::flash('product_name', $product->name);

		return redirect()->route('catalogs.index')
			->withCookie(cookie()->forever('cart', json_encode($cart)));
	}

	public function show()
	{
		return view('carts.index');
	}

	public function update(Request $request, Product $product)
	{
		$this->validate($request, [
			'quantity' => 'required|integer|min:1',
		]);
		$quantity = $request->quantity;
		$cart = $this->cart->find($product->id);
		if (!$cart) {
			return redirect()->route('cart.show');
		}
		flash()->success('Jumlah order untuk ' . $cart['detail']['name'] . ' berhasil dirubah.');
		$cart = json_decode(request()->cookie('cart'), true) ?? [];
		$cart[$product->id] = $quantity;

		return redirect()->route('cart.show')
			->withCookie(cookie()->forever('cart', json_encode($cart)));
	}

	public function destroy(Product $product)
	{
		$cart = $this->cart->find($product->id);
		if (!$cart) {
			return redirect()->route('cart.show');
		}
		flash()->success($cart['detail']['name'] . ' berhasil dihapus dari cart.');
		$cart = json_decode(request()->cookie('cart'), true) ?? [];
		unset($cart[$product->id]);

		return redirect()->route('cart')
			->withCookie(cookie()->forever('cart', json_encode($cart)));
	}
}
