<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->integer('parent_id');
			$table->timestamps();
		});

		Schema::create('category_product', function (Blueprint $table) {
			$table->id();
			$table->foreignId('product_id')->constrained('products');
			$table->foreignId('category_id')->constrained('categories');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::table('category_product', function (Blueprint $table) {
			$table->dropForeign(['product_id']);
			$table->dropForeign(['category_id']);
		});

		Schema::dropIfExists('categories');
		Schema::dropIfExists('category_product');
	}
}
