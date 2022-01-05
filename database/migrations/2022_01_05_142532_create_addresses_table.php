<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::create('addresses', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users');
			$table->string('city_id', 20);
			$table->foreign('city_id')->references('city_id')->on('ro_city');
			$table->string('name');
			$table->string('detail');
			$table->string('phone');
			$table->index(['city_id', 'user_id']);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::table('addresses', function (Blueprint $table) {
			$table->dropForeign(['user_id']);
			$table->dropForeign(['city_id']);
		});
		Schema::dropIfExists('addresses');
	}
}
