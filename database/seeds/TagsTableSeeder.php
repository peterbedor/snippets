<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\Models\Tag::class, 100)->create();

		$ids = \App\Models\Snippet::all()->map(function($snippet) {
			return $snippet->id;
		});

		\App\Models\Tag::all()->each(function($tag) use ($ids) {
			DB::table('snippet_tag')
				->insert([
					'snippet_id' => $ids->random(),
					'tag_id' => $tag->id,
				]);
		});
	}
}
