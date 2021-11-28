<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
	/**
	 * Handle an incoming request.
	 *
	 * @param mixed $role
	 *
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next, $role)
	{
		if (Auth::user()->can($role . '-access')) {
			return $next($request);
		}

		return abort('Unautorized', 401);
	}
}
