<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use Illuminate\Database\Seeder;

class AddressesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run()
	{
		Province::populate();
		City::populate();

		$user = User::where('email', 'customer@mail.com')->first();
		$address1 = Address::create([
			'user_id' => $user->id,
			'city_id' => 130,
			'name' => 'Budy',
			'detail' => 'Jl. Budi Utomo',
			'phone' => '089911223344',
		]);
		$address2 = Address::create([
			'user_id' => $user->id,
			'city_id' => 131,
			'name' => 'Ahmad',
			'detail' => 'Jl. Ahmad Yani',
			'phone' => '083321124354',
		]);

		$this->command->info('Success add addresses');
	}
}
