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
			'photo' => 'mimes:jpeg,png|max:10240',
			'price' => 'required|numeric|min:1000',
		]);
		$data = $request->only('name', 'price', 'model');

		if ($request->hasFile('photo')) {
			$data['photo'] = $request->file('photo')->store('public/products');
		}

		$product = Product::create($data);
		$product->categories()->sync($request->categories);
		flash()->success($request->title . ' product saved.');

		return redirect()->route('products.index');
	}

	public function edit(Product $product)
	{
		$categories = Category::pluck('title', 'id')->toArray();

		return view('categories.edit', compact('product', 'categories'));
	}

	public function update(Request $request, Product $product)
	{
		$this->validate($request, [
			'title' => 'required|string|max:255|unique:categories,title,' . $product->id,
			'parent_id' => 'nullable|exists:categories,id',
		]);
		$product->update($request->all());
		flash()->success($request->title . ' product updated.');

		return redirect()->route('products.index');
	}

	public function destroy(Product $product)
	{
		flash()->success($product->title . ' product deleted.');
		$product->delete();

		return redirect()->route('products.index');
	}
}
