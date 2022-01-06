<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('photo');
			$table->string('model');
			$table->decimal('price', 10, 2);
			$table->decimal('weight', 8, 2);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::dropIfExists('products');
	}
}
