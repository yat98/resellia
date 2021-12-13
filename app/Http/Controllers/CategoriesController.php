<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
	public function index(Request $request)
	{
		$categories = Category::where('title', 'LIKE', "%{$request->q}%")
			->paginate(5)
			->appends(['q' => $request->q]);

		return view('categories.index', compact('categories'));
	}

	public function show(Category $category)
	{
	}

	public function create()
	{
		$parents = ['' => ''] + Category::pluck('title', 'id')->toArray();

		return view('categories.create', compact('parents'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required|string|max:255|unique:categories',
			'parent_id' => 'exists:categories,id',
		]);
		Category::create($request->all());
		flash()->success($request->title . ' category saved.');

		return redirect()->route('categories.index');
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
