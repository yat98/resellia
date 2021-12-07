<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run()
	{
		$shoes = Category::create(['title' => 'Shoes']);
		$shoes->childs()->saveMany([
			new Category(['title' => 'Lifestyle']),
			new Category(['title' => 'Running']),
			new Category(['title' => 'Basket']),
			new Category(['title' => 'Football']),
		]);

		$tshirts = Category::create(['title' => 'Clothes']);
		$tshirts->childs()->saveMany([
			new Category(['title' => 'Jacket']),
			new Category(['title' => 'Hoodie']),
			new Category(['title' => 'Vest']),
		]);

		$running = Category::where('title', 'Running')->first();
		$lifestyle = Category::where('title', 'Lifestyle')->first();
		$shoes1 = Product::create([
			'name' => 'Nike Air Force',
			'photo' => 'stub-shoe.jpg',
			'model' => 'Man Shoes',
			'price' => 340000,
		]);
		$shoes2 = Product::create([
			'name' => 'Nike Air Max',
			'photo' => 'stub-shoe.jpg',
			'model' => 'Woman Shoes',
			'price' => 420000,
		]);
		$shoes3 = Product::create([
			'name' => 'Nike Air Zoom',
			'photo' => 'stub-shoe.jpg',
			'model' => 'Woman Shoes',
			'price' => 360000,
		]);
		$running->products()->saveMany([$shoes1, $shoes2, $shoes3]);
		$lifestyle->products()->saveMany([$shoes1, $shoes2]);

		$jacket = Category::where('title', 'Jacket')->first();
		$vest = Category::where('title', 'Vest')->first();
		$jacket1 = Product::create([
			'name' => 'Nike Aeroloft Bomber',
			'photo' => 'stub-shoe.jpg',
			'model' => 'Woman Jacket',
			'price' => 720000,
		]);
		$jacket2 = Product::create([
			'name' => 'Nike Guild 550',
			'photo' => 'stub-shoe.jpg',
			'model' => 'Man Jacket',
			'price' => 380000,
		]);
		$jacket3 = Product::create([
			'name' => 'Nike SB Steele',
			'photo' => 'stub-shoe.jpg',
			'model' => 'Man Jacket',
			'price' => 1200000,
		]);
		$jacket->products()->saveMany([$jacket1, $jacket2, $jacket3]);
		$vest->products()->saveMany([$jacket1, $jacket2]);
		$this->command->info('Success add products');
	}
}
