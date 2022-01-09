<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		if (auth()->user()->can('customer-access')) {
			return redirect()->route('catalogs.index');
		}

		return view('home');
	}

	public function viewOrders(Request $request)
	{
		$q = $request->q;
		$status = $request->status;
		$statusList = Order::statusList();
		$orders = auth()->user()->orders()
			->where('id', 'like', "%{$q}%")
			->where('status', 'like', "%{$status}%")
			->orderBy('updated_at')
			->paginate(5)
			->appends([
				'q' => $q,
				'status' => $status,
			]);

		return view('customer.view-orders', compact('q', 'status', 'orders', 'statusList'));
	}
}
