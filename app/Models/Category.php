<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	use HasFactory;

	protected $fillable = [
		'title',
		'parent_id',
	];

	public static function boot()
	{
		parent::boot();
		static::deleting(function ($model) {
			$model->products()->detach();
			foreach ($model->childs as $child) {
				$child->update([
					'parent_id' => '',
				]);
			}
		});
	}

	public function childs()
	{
		return $this->hasMany(Category::class, 'parent_id');
	}

	public function parent()
	{
		return $this->belongsTo(Category::class, 'parent_id');
	}

	public function products()
	{
		return $this->belongsToMany(Product::class);
	}
}
