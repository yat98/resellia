<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

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
			'photo' => 'stub-shoe.jpeg',
			'model' => 'Man Shoes',
			'price' => 340000,
			'weight' => rand(1, 3) * 1000,
		]);
		$shoes2 = Product::create([
			'name' => 'Nike Air Max',
			'photo' => 'stub-shoe.jpeg',
			'model' => 'Woman Shoes',
			'price' => 420000,
			'weight' => rand(1, 3) * 1000,
		]);
		$shoes3 = Product::create([
			'name' => 'Nike Air Zoom',
			'photo' => 'stub-shoe.jpeg',
			'model' => 'Woman Shoes',
			'price' => 360000,
			'weight' => rand(1, 3) * 1000,
		]);
		$running->products()->saveMany([$shoes1, $shoes2, $shoes3]);
		$lifestyle->products()->saveMany([$shoes1, $shoes2]);

		$jacket = Category::where('title', 'Jacket')->first();
		$vest = Category::where('title', 'Vest')->first();
		$jacket1 = Product::create([
			'name' => 'Nike Aeroloft Bomber',
			'photo' => 'stub-jacket.jpg',
			'model' => 'Woman Jacket',
			'price' => 720000,
			'weight' => rand(1, 3) * 1000,
		]);
		$jacket2 = Product::create([
			'name' => 'Nike Guild 550',
			'photo' => 'stub-jacket.jpg',
			'model' => 'Man Jacket',
			'price' => 380000,
			'weight' => rand(1, 3) * 1000,
		]);
		$jacket3 = Product::create([
			'name' => 'Nike SB Steele',
			'photo' => 'stub-jacket.jpg',
			'model' => 'Man Jacket',
			'price' => 1200000,
			'weight' => rand(1, 3) * 1000,
		]);
		$jacket->products()->saveMany([$jacket1, $jacket2, $jacket3]);
		$vest->products()->saveMany([$jacket1, $jacket2]);

		$from = database_path() . DIRECTORY_SEPARATOR . 'seeders' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR;
		$to = storage_path() . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR;
		File::copy($from . 'stub-jacket.jpg', $to . 'stub-jacket.jpg');
		File::copy($from . 'stub-shoe.jpeg', $to . 'stub-shoe.jpeg');

		$this->command->info('Success add products');
	}
}
