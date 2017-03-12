<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\Models\Comment::class, 1000)
			->make()
			->each(function($comment) {
				$snippet = App\Models\Snippet::all()->random();

				$user = App\Models\User::all()->random();

				//if ((bool) random_int(0, 1)) {
				//	$parent = App\Models\Comment::where('snippet_id', $snippet->id)->get();
				//
				//	if (count($parent)) {
				//		$parent = $parent->random();
				//
				//		$comment->reply()->associate($parent);
				//	}
				//}

				$comment->author()->associate($user);
				$comment->snippet()->associate($snippet);
				$comment->save();
			});
    }
}
