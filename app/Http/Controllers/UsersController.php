<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
	public function get(Request $request)
	{
		return response()->json([
			'users' => Auth::user()
		]);
    }

	public function list()
	{
		return response()->json(User::all());
    }

	public function search(Request $request)
	{
		return User::search($request->input('query'))->get();
    }
}
