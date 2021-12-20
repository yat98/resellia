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
		$products = Product::query();
		$categoryNoParent = Category::noParent()->get();
		$countProducts = Product::count();

		if ($request->has('q')) {
			$q = $request->q;
			$products = $products->where('name', 'like', "%{$q}%");
			$data = array_merge($data, compact('q'));
		}

		if ($request->has('cat')) {
			$cat = $request->cat;
			$category = Category::find($cat);
			$products = $products->whereIn('id', $category->related_products_id ?? [])
				->paginate(4)
				->appends(['cat' => $cat]);
			$data = array_merge($data, compact('cat', 'category'));
		} else {
			$products = $products->paginate(4);
		}

		if ($request->has('q')) {
			$products = $products->appends(['q' => $q]);
		}
		$data = array_merge($data, compact('products', 'categoryNoParent', 'countProducts'));

		return view('catalogs.index', $data);
	}
}
