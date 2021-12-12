<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
	public function index(Request $request)
	{
		$categories = Category::where('title', 'LIKE', "%{$request->q}%")
			->paginate(10)
			->appends(['q' => $request->q]);

		return view('categories.index', compact('categories'));
	}

	public function show(Category $category)
	{
	}

	public function store(Request $request)
	{
	}

	public function edit(Category $category)
	{
	}

	public function update(Request $request, Category $category)
	{
	}

	public function destroy(Category $category)
	{
	}
}
