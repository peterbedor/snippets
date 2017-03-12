<?php

namespace App\Traits;

trait JsonResponse
{
	public function success($message = 'success', $payload = false)
	{
		return response(200)->json([
			'message' => $message,
			'payload' => $payload,
		]);
	}
}