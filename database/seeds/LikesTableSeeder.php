<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class LikesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i = 0; $i < 500; $i++) {
			$user = \App\Models\User::all()->random();
			$snippet = \App\Models\Snippet::all()->random();

			Auth::login($user);

			$snippet->like();

			Auth::logout();
		}
	}
}
