<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Irfa\RajaOngkir\Facades\Ongkir as RajaOngkir;

class City extends Model
{
	use HasFactory;

	protected $table = 'ro_city';

	protected $fillable = [
		'city_id',
		'province_id',
		'province',
		'type',
		'city_name',
		'postal_code',
	];

	public static function populate()
	{
		$cities = RajaOngkir::city()->get();
		foreach ($cities as $city) {
			$model = static::firstOrNew([
				'city_id' => $city->city_id,
				'province_id' => $city->province_id,
				'province' => $city->province,
				'type' => $city->type,
				'city_name' => $city->city_name,
				'postal_code' => $city->postal_code,
			]);
			$model->save();
		}
	}

	public function provinces()
	{
		return $this->belongsTo(Province::class, 'province_id', 'province_id');
	}
}
