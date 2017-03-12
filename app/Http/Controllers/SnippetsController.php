<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Snippet;
use Illuminate\Http\Request;

class SnippetsController extends Controller
{
	/**
	 * SnippetsController constructor.
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Display a listing of the snippets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$snippets = Snippet::with('files.language', 'author', 'likes', 'likers', 'comments')
			->paginate(10);

        return $this->handleResponse('snippets.index', [
        	'snippets' => $snippets
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->handleResponse('snippets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
		$snippet = Snippet::getBySlug($slug);

		return $this->handleResponse('snippets.show', compact('snippet'));
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
    public function destroy($id)
    {
        //
    }
}
