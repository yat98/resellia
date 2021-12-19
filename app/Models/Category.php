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
					'parent_id' => null,
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

	public function getRelatedProductsIdAttribute()
	{
		$result = $this->products->pluck('id')->toArray();
		foreach ($this->childs as $child) {
			$result = array_merge($result, $child->related_products_id);
		}

		return $result;
	}

	public function getTotalProductsAttribute()
	{
		return Product::whereIn('id', $this->related_products_id)->count();
	}

	public function scopeNoParent($query)
	{
		return $query->where('parent_id', null);
	}

	public function hasChild()
	{
		return $this->childs()->count() > 0;
	}

	public function hasParent()
	{
		return null != $this->parent_id;
	}
}
