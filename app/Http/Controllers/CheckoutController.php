<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutAddressRequest;
use App\Http\Requests\CheckoutLoginRequest;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class CheckoutController extends Controller
{
	public function login()
	{
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

		$provinces = Province::pluck('province', 'province_id')->toArray();

		return view('checkout.address', compact('provinces', 'cities'));
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

	public function postPayment()
	{
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
		return 'Akan diisi login authenticated checkout';
	}

	protected function guestAddress(CheckoutAddressRequest $request)
	{
		$this->saveAddressSession($request);

		return redirect()->route('checkout.payment');
	}

	protected function authenticatedAddress(CheckoutAddressRequest $request)
	{
		return 'Akan diisi login authenticated address';
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
}
