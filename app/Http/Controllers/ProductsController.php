<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
	public function index(Request $request)
	{
		$products = Product::where('name', 'LIKE', "%{$request->q}%")
			->orWhere('model', 'LIKE', "%{$request->q}%")
			->paginate(5)
			->appends(['q' => $request->q]);

		return view('products.index', compact('products'));
	}

	public function create()
	{
		$categories = Category::pluck('title', 'id')->toArray();

		return view('products.create', compact('categories'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|unique:products',
			'model' => 'required',
			'photo' => 'required|mimes:jpeg,png|max:10240',
			'price' => 'required|numeric|min:1000',
			'weight' => 'required|numeric|min:1',
		]);
		$data = $request->only('name', 'price', 'model', 'weight');
		if ($request->hasFile('photo')) {
			$data['photo'] = $this->uploadFile($request, 'photo', '/public/products');
		}
		$product = Product::create($data);
		$product->categories()->sync($request->categories);
		flash()->success($request->name . ' product saved.');

		return redirect()->route('products.index');
	}

	public function edit(Product $product)
	{
		$categories = Category::pluck('title', 'id')->toArray();

		return view('products.edit', compact('product', 'categories'));
	}

	public function update(Request $request, Product $product)
	{
		$this->validate($request, [
			'name' => 'required|unique:products,name,' . $product->id,
			'model' => 'required',
			'photo' => 'sometimes|mimes:jpeg,png|max:10240',
			'price' => 'required|numeric|min:1000',
			'weight' => 'required|numeric|min:1',
		]);
		$data = $request->only('name', 'price', 'model', 'weight');
		if ($request->hasFile('photo')) {
			$data['photo'] = $this->uploadFile($request, 'photo', '/public/products');
			if ('' != $product->photo) {
				$this->deleteFile('/products/' . $product->photo);
			}
		}
		$product->update($data);
		if (null != $request->categories) {
			$product->categories()->sync($request->categories);
		} else {
			$product->categories()->detach();
		}
		flash()->success($request->name . ' product updated.');

		return redirect()->route('products.index');
	}

	public function destroy(Product $product)
	{
		$product->delete();
		if ('' != $product->photo) {
			$this->deleteFile('/products/' . $product->photo);
		}
		flash()->success($product->name . ' product deleted.');

		return redirect()->route('products.index');
	}
}
