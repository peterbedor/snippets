<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
			'PHP' => 'php',
			'JavaScript' => 'js',
			'HTML' => 'html',
			'Twig' => 'twig',
			'MySQL' => 'sql',
			'Bash' => 'sh',
		];

        foreach ($languages as $name => $extension) {
			$language = new \App\Models\Language([
				'name' => $name,
				'slug' => str_slug($name),
				'extension' => $extension
			]);

			$language->save();
		}
    }
}
