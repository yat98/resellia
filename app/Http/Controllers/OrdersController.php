<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
	public function index(Request $request)
	{
		$status = $request->status;
		$orders = Order::where('status', 'like', "%{$status}%")->paginate(10);
		$statusList = Order::statusList();
		if ($request->has('status')) {
			$orders->appends(['status' => $status]);
		}

		return view('orders.index', compact('orders', 'statusList', 'status'));
	}

	public function edit($id)
	{
	}

	public function update(Request $request, $id)
	{
	}
}
