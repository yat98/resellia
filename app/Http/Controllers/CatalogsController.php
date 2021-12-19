<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogsController extends Controller
{
	public function index(Request $request)
	{
		$data = [];
		$categoryNoParent = Category::noParent()->get();
		$countProducts = Product::count();
		if ($request->has('cat')) {
			$cat = $request->cat;
			$category = Category::findOrFail($cat);
			$products = Product::whereIn('id', $category->related_products_id)
				->paginate(4)
				->appends(['cat' => $cat]);
			$data = array_merge($data, compact('cat', 'category'));
		} else {
			$products = Product::paginate(4);
		}
		$data = array_merge($data, compact('products', 'categoryNoParent', 'countProducts'));

		return view('catalogs.index', $data);
	}
}
