<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function handleResponse($view, $data = [])
	{
		if (request()->pjax()) {
			$data = array_merge($data, [
				'pjax' => true
			]);
		}

		return view($view, $data);
	}
}
