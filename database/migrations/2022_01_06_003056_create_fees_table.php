<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::create('fees', function (Blueprint $table) {
			$table->id();
			$table->integer('origin');
			$table->integer('destination');
			$table->string('courier');
			$table->string('service');
			$table->integer('weight');
			$table->integer('cost')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down()
	{
		Schema::dropIfExists('fees');
	}
}
