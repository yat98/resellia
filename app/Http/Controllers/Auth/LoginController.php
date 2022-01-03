<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Supports\CartService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles authenticating users for the application and
	| redirecting them to your home screen. The controller uses a trait
	| to conveniently provide its functionality to your applications.
	|
	*/

	use AuthenticatesUsers;
	protected $cart;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = RouteServiceProvider::HOME;

	/**
	 * Create a new controller instance.
	 */
	public function __construct(CartService $cart)
	{
		$this->middleware('guest')->except('logout');
		$this->cart = $cart;
	}

	protected function authenticated(Request $request, $user)
	{
		if ($user->can('customer-access')) {
			$cookie = $this->cart->merge();

			return redirect($this->redirectTo)->withCookie($cookie);
		}

		return redirect($this->redirectTo);
	}
}
