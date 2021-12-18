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
	];

	public function categories()
	{
		return $this->belongsToMany(Category::class);
	}

	public static function boot()
	{
		parent::boot();
		static::deleting(function ($model) {
			$model->categories()->detach();
		});
	}
}
