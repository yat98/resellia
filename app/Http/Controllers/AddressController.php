<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class AddressController extends Controller
{
	public function cities(Request $request)
	{
		$this->validate($request, [
			'province_id' => 'required|exists:ro_province,province_id',
		]);

		$cities = City::where('province_id', $request->province_id)->get();

		return $cities->map(function ($city) {
			return [
				'city_id' => $city->city_id,
				'province_id' => $city->province_id,
				'name' => $city->type . ' ' . $city->city_name,
			];
		});
	}
}
