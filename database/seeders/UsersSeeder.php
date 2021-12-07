<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run()
	{
		User::create([
			'name' => 'Admin',
			'email' => 'admin@mail.com',
			'password' => 'secret123',
			'role' => 'admin',
		]);

		User::create([
			'name' => 'Customer',
			'email' => 'customer@mail.com',
			'password' => 'secret123',
			'role' => 'customer',
		]);

		$this->command->info('Success add users');
	}
}
