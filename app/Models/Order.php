<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'address_id',
		'status',
		'bank',
		'sender',
		'total_payment',
	];

	public function refreshTotalPayment()
	{
		$totalPayment = 0;
		foreach ($this->details as $detail) {
			$totalPayment += $detail->total_price;
		}
		$this->total_payment = $totalPayment;
		$this->save();
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function address()
	{
		return $this->belongsTo(Address::class, 'address_id');
	}

	public function details()
	{
		return $this->hasMany(OrderDetails::class, 'order_id');
	}

	public function getPaddedIdAttribute(){
		return str_pad($this->id, 6, 0, STR_PAD_LEFT);
	}
}
