<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CatalogsController extends Controller
{
	public function index()
	{
		$products = Product::paginate(4);

		return view('catalogs.index', compact('products'));
	}
}
