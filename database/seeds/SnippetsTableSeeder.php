<?php

use Illuminate\Database\Seeder;

class SnippetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$snippets = factory(App\Models\Snippet::class, 100)->make();

		$snippets->each(function($snippet) {
			$files = factory(App\Models\File::class, rand(1, 5))->make();

			$user = App\Models\User::all()->random();

			$user->snippets()->save($snippet);

			$files->each(function($file) use ($snippet) {
				$language = App\Models\Language::where('slug', 'php')->first();

				$file->language()->associate($language);

				$file->snippet()->associate($snippet);

				$snippet->files()->save($file);
			});
		});
    }
}
