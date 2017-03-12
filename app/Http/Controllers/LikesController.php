<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikesController extends Controller
{
	public function like()
	{
		$type = $this->getType(request('type'));

		$instance = new $type();

		$resource = $instance->where('id', request('id'))
			->first();

		return response()->json([
			'success' => !! $resource->toggleLike(),
			'count' => $resource->likesCount
		]);
	}

	private function getType($type)
	{
		$types = [
			'snippet' => \App\Models\Snippet::class
		];

		return $types[$type] ?? false;
	}
}
