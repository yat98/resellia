<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Irfa\RajaOngkir\Facades\Ongkir as RajaOngkir;

class Fee extends Model
{
	use HasFactory;

	protected $fillable = [
		'origin',
		'destination',
		'courier',
		'service',
		'weight',
		'cost',
	];

	public static function getCost($origin, $destination, $weight, $courier, $service)
	{
		$fee = static::firstOrCreate([
			'origin' => $origin,
			'destination' => $destination,
			'courier' => $courier,
			'service' => $service,
			'weight' => $weight,
		]);

		if ($fee->haveCost() && !$fee->isNeedUpdate()) {
			return $fee->cost;
		}

		return $fee->populateCost();
	}

	public function populateCost()
	{
		$params = $this->toArray();
		$costs = RajaOngkir::find($params)->costDetails()->get();
		$total = 0;
		foreach ($costs as $cost) {
			if ($cost->service == $this->service) {
				$total = $cost->cost[0]->value;

				break;
			}
		}

		$total = $total > 0 ? $total : config('rajaongkir.fallback_fee');
		$this->update([
			'cost' => $total,
			'updated_at' => Carbon::now(),
		]);

		return $total;
	}

	protected function haveCost()
	{
		return $this->cost > 0;
	}

	protected function isNeedUpdate()
	{
		return $this->updated_at->diffInDays(Carbon::today()) > 7;
	}
}
