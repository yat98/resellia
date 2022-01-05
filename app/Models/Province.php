<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Irfa\RajaOngkir\Facades\Ongkir as RajaOngkir;

class Province extends Model
{
	use HasFactory;

	protected $table = 'ro_province';

	protected $fillable = [
		'province_id',
		'province',
	];

	public static function populate()
	{
		$provinces = RajaOngkir::province()->get();
		foreach ($provinces as $province) {
			$model = static::firstOrNew([
				'province_id' => $province->province_id,
				'province' => $province->province,
			]);
			$model->save();
		}
	}

	public function city()
	{
		return $this->hasMany(City::class, 'province_id', 'province_id');
	}
}
