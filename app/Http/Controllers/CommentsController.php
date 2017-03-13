<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\StoreComment;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param StoreComment $request
	 * @return Comment
	 */
	public function store(StoreComment $request, $slug)
	{
		$data = Comment::createComment(
			$request->input('body'),
			$slug,
			$request->input('parentId', null),
			$request->input('mentions', null)
		);

		return view('partials.comment', [
			'data' => $data,
			'slug' => $slug
 		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		$success = false;
		$comment = Comment::find($request->input('id'));

		if ($comment->user_id === Auth::id()) {
			$success = Comment::destroy($request->input('id'));
		}

		if ($success) {
			return response()->json([
				'message' => 'Success'
			]);
		}
	}
}
