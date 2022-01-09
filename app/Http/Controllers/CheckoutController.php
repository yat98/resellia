<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutAddressRequest;
use App\Http\Requests\CheckoutLoginRequest;
use App\Models\Address;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Province;
use App\Models\User;
use App\Supports\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class CheckoutController extends Controller
{
	protected $cart;

	public function __construct(CartService $cart)
	{
		$this->cart = $cart;
	}

	public function login()
	{
		if (Auth::check()) {
			return redirect()->route('checkout.address');
		}

		return view('checkout.login');
	}

	public function postLogin(CheckoutLoginRequest $request)
	{
		$email = $request->email;
		$password = $request->checkout_password;
		$isGuest = $request->is_guest > 0;

		if ($isGuest) {
			return $this->guestCheckout($email);
		}

		return $this->authenticatedCheckout($email, $password);
	}

	public function address()
	{
		$cities = [];
		$addresses = [];
		if (!empty(request()->old('province_id'))) {
			$cities = City::where('province_id', request()->old('province_id'))->get();

			$cities = $cities->map(function ($city) {
				return [
					'city_id' => $city->city_id,
					'province_id' => $city->province_id,
					'name' => $city->type . ' ' . $city->city_name,
				];
			})->pluck('name', 'city_id')->toArray();
		}

		if (Auth::check()) {
			$addresses = auth()->user()->addresses ?? [];
		}

		$provinces = Province::pluck('province', 'province_id')->toArray();

		return view('checkout.address', compact('provinces', 'cities', 'addresses'));
	}

	public function postAddress(CheckoutAddressRequest $request)
	{
		if (Auth::check()) {
			return $this->authenticatedAddress($request);
		}

		return $this->guestAddress($request);
	}

	public function payment()
	{
		return view('checkout.payment');
	}

	public function postPayment(Request $request)
	{
		$this->validate($request, [
			'bank_name' => 'required|in:' . implode(',', array_keys(bankList())),
			'sender' => 'required',
		]);

		session([
			'checkout.payment.bank' => $request->bank_name,
			'checkout.payment.sender' => $request->sender,
		]);

		if (Auth::check()) {
			return $this->authenticatedPayment($request);
		}

		return $this->guestPayment($request);
	}

	public function success()
	{
		return view('checkout.success');
	}

	protected function guestCheckout($email)
	{
		if ($user = User::where('email', $email)->first()) {
			if ($user->hasPassword()) {
				$errors = new MessageBag();
				$errors->add('checkout_password', 'Alamat email "' . $email . '" sudah terdaftar, silahkan masukan password');

				return redirect()->route('checkout.login')
					->withErrors($errors)
					->withInput(compact('email') + ['is_guest' => 0]);
			}
			session()->flash('email', $email);

			return view('checkout.reset-password');
		}

		session(['checkout.email' => $email]);

		return redirect()->route('checkout.address');
	}

	protected function authenticatedCheckout($email, $password)
	{
		if (!Auth::attempt(['email' => $email, 'password' => $password])) {
			$errors = new MessageBag();
			$errors->add('email', 'Data user yang dimasukkan salah');

			return redirect()->route('checkout.login')
				->withInput(compact('email', 'password') + ['is_guest' => 0])
				->withErrors($errors);
		}

		$deleteCookie = $this->cart->merge();

		return redirect()->route('checkout.address')
			->withCookie($deleteCookie);
	}

	protected function guestAddress(CheckoutAddressRequest $request)
	{
		$this->saveAddressSession($request);

		return redirect()->route('checkout.payment');
	}

	protected function authenticatedAddress(CheckoutAddressRequest $request)
	{
		$addressId = $request->address_id;
		session()->forget('checkout.address');
		if ('new-address' == $addressId) {
			$this->saveAddressSession($request);
		} else {
			session(['checkout.address.address_id' => $addressId]);
		}

		return redirect()->route('checkout.payment');
	}

	protected function saveAddressSession(CheckoutAddressRequest $request)
	{
		session([
			'checkout.address.name' => $request->name,
			'checkout.address.detail' => $request->detail,
			'checkout.address.province_id' => $request->province_id,
			'checkout.address.city_id' => $request->city_id,
			'checkout.address.phone' => $request->phone,
		]);
	}

	protected function guestPayment($request)
	{
		$user = $this->setupCustomer(session('checkout.email'), session('checkout.address.name'));
		$bank = session('checkout.payment.bank');
		$sender = session('checkout.payment.sender');
		$address = $this->setupAddress($user, session('checkout.address'));
		$order = $this->makeOrder($user->id, $bank, $sender, $address, $this->cart->details());
		session()->forget('checkout');
		$deleteCookie = $this->cart->clearCartCookie();

		return redirect()->route('checkout.success')
			->with(compact('order'))
			->withCookie($deleteCookie);
	}

	protected function setupCustomer($email, $name)
	{
		return User::create(compact('email', 'name') + ['role' => 'customer']);
	}

	protected function setupAddress(User $customer, $addressSession)
	{
		if (auth()->check()) {
			return Address::find($addressSession['address_id']);
		}

		return Address::create([
			'user_id' => $customer->id,
			'city_id' => $addressSession['city_id'],
			'name' => $addressSession['name'],
			'detail' => $addressSession['detail'],
			'phone' => $addressSession['phone'],
		]);
	}

	protected function authenticatedPayment($request)
	{
		$user = Auth::user();
		$bank = session('checkout.payment.bank');
		$sender = session('checkout.payment.sender');
		$address = $this->setupAddress($user, session('checkout.address'));
		$order = $this->makeOrder($user->id, $bank, $sender, $address, $this->cart->details());
		session()->forget('checkout');
		$this->cart->clearCartRecord();

		return redirect()->route('checkout.success')
			->with(compact('order'));
	}

	protected function makeOrder($user_id, $bank, $sender, Address $address, $cart)
	{
		$address_id = $address->id;
		$order = Order::create(compact('user_id', 'address_id', 'bank', 'sender'));
		foreach ($cart as $product) {
			OrderDetails::create([
				'order_id' => $order->id,
				'product_id' => $product['id'],
				'quantity' => $product['quantity'],
				'price' => $product['detail']['price'],
				'fee' => Product::find($product['id'])->getCostTo($address->city_id),
			]);
		}

		return Order::find($order->id);
	}
}
