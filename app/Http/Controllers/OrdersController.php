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
			->where(function ($query) use ($q) {
				$query->where('id', "{$q}")
					->orwhereHas('user', function ($query) use ($q) {
						$query->where('name', 'like', "%{$q}%");
					});
			})
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

	public function edit(Order $order)
	{
		$statusList = Order::statusList();

		return view('orders.edit', compact('order', 'statusList'));
	}

	public function update(Request $request, Order $order)
	{
		$this->validate($request, [
			'status' => 'required|in:' . implode(',', Order::allowedStatus()),
		]);

		$order->update($request->only('status'));
		flash()->success($order->padded_id . ' order updated.');

		return redirect()->route('orders.index');
	}
}
