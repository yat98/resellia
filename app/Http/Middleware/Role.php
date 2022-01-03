<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
		if ($request->user()->can($role . '-access')) {
			return $next($request);
		}

		return abort('Unautorized', 401);
	}
}
