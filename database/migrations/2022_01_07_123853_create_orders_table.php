<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users');
			$table->foreignId('address_id')->constrained('addresses');
			$table->string('status')->default('waiting-payment');
			$table->string('bank');
			$table->string('sender');
			$table->decimal('total_payment', 18, 2)->default(0);
			$table->timestamps();
		});

		Schema::create('order_details', function (Blueprint $table) {
			$table->id();
			$table->foreignId('order_id')->constrained('orders');
			$table->foreignId('product_id')->constrained('products');
			$table->integer('quantity');
			$table->decimal('price', 10, 2);
			$table->decimal('fee', 10, 2);
			$table->decimal('total_price', 10, 2)->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::table('orders', function (Blueprint $table) {
			$table->dropForeign(['user_id']);
			$table->dropForeign(['address_id']);
		});
		Schema::table('order_details', function (Blueprint $table) {
			$table->dropForeign(['order_id']);
			$table->dropForeign(['product_id']);
		});
		Schema::dropIfExists('orders');
		Schema::dropIfExists('order_details');
	}
}
