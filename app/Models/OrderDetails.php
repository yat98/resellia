<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
	use HasFactory;

	protected $table = 'order_details';

	protected $fillable = [
		'order_id',
		'product_id',
		'quantity',
		'price',
		'fee',
		'total_price',
	];

	public static function boot()
	{
		parent::boot();
		static::saved(function ($model) {
			if ($model->total_price < 1) {
				$model->refreshTotalPrice();
			}
			$model->order->refreshTotalPayment();
		});
	}

	public function order()
	{
		return $this->belongsTo(Order::class, 'order_id');
	}

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}

	public function refreshTotalPrice()
	{
		$totalPrice = ($this->price + $this->fee) * $this->quantity;
		$this->total_price = $totalPrice;
		$this->save();
	}
}
