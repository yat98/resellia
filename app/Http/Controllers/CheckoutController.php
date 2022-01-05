<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutLoginRequest;
use App\Models\User;
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

	public function getAddress()
	{
		return session()->get('checkout.email');
	}

	protected function guestCheckout($email)
	{
		if ($user = User::where('email', $email)->first()) {
			if ($user->hasPassword()) {
				$errors = new MessageBag();
				$errors->add('checkout_password', 'Alamat email "' . $email . '" sudah terdaftar, silahkan masukan password');

				return redirect()->route('checkout.index')
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
	}
}
