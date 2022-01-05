<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'city_id',
		'name',
		'detail',
		'phone',
	];

	public function city()
	{
		return $this->belongsTo(City::class, 'city_id');
	}
}
