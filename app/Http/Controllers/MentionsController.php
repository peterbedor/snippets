<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMention;
use App\Models\Mention;
use App\Models\User;
use Illuminate\Http\Request;

class MentionsController extends Controller
{
	public function store(StoreMention $request)
	{
		$mention = Mention::saveMention(
			$request->input('username'),
			$request->input('commentId'),
			$request->input('snippetSlug')
		);
	}
}
