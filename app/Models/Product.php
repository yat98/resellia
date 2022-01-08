<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'photo',
		'model',
		'price',
		'weight',
	];

	public static function boot()
	{
		parent::boot();
		static::deleting(function ($model) {
			$model->categories()->detach();
			$model->carts()->delete();
		});
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class);
	}

	public function carts()
	{
		return $this->hasMany(Cart::class, 'product_id');
	}

	public function orderDetails()
	{
		return $this->hasMany(OrderDetails::class, 'product_id');
	}

	public function getCostTo($destinationId)
	{
		return Fee::getCost(
			config('irfa.rajaongkir.origin'),
			$destinationId,
			$this->weight,
			config('irfa.rajaongkir.courier'),
			config('irfa.rajaongkir.service'),
		);
	}
}
