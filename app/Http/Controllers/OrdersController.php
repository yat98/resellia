<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
	public function index(Request $request)
	{
		$status = $request->status;
		$q = $request->q;
		$orders = Order::where('status', 'like', "%{$status}%")
			->where('id', 'like', "%{$q}%")
			->paginate(10);
		$statusList = Order::statusList();
		if ($request->has('status')) {
			$orders->appends(['status' => $status]);
		}
		if ($request->has('q')) {
			$orders->appends(['q' => $q]);
		}

		return view('orders.index', compact('orders', 'statusList', 'status', 'q'));
	}

	public function edit($id)
	{
	}

	public function update(Request $request, $id)
	{
	}
}
