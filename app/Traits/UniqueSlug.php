<?php
namespace App\Traits;

trait UniqueSlug
{
	public static function uniqueifySlug($model, $item)
	{
		$latest = $model::whereRaw("slug RLIKE '^{$item->slug}(-[0-9]*)?$'")
			->latest('id')
			->first();

		if ($latest) {
			$pieces = explode('-', $latest->slug);

			$number = intval(end($pieces));

			$item->slug .= '-' . ($number + 1);
		}
	}
}