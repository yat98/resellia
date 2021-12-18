<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Controller extends BaseController
{
	use AuthorizesRequests;
	use DispatchesJobs;
	use ValidatesRequests;

	protected function uploadFile(Request $request, $name, $path)
	{
		$file = $request->file($name);
		$name = Str::random(32) . '.' . $file->getClientOriginalExtension();
		$file->storeAs($path, $name);

		return $name;
	}

	protected function deleteFile($name)
	{
		$storage = Storage::disk('public');
		if ($storage->exists($name)) {
			$storage->delete($name);
		}
	}
}
