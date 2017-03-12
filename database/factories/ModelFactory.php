<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    $email = $faker->unique()->safeEmail;

    return [
        'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'username' => $faker->userName,
        'email' => $email,
		'avatar' => 'https://api.adorable.io/avatars/285/' . $email . '.png',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Snippet::class, function(Faker\Generator $faker) {
	$name = $faker->word;

	return [
		'name' => $name,
		'description' => $faker->paragraph,
		'slug' => str_slug($name)
	];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\File::class, function(Faker\Generator $faker) {
	$name = $faker->word;

	return [
		'name' => $name,
		'slug' => str_slug($name),
		'body' => '<?php
/**
 * teratail - Q&A community for every thinking engineer
 *
 * @author Leverages Co. Ltd. Technology Media Lab.
 * @since 2014/07/16
 */
function teratail(ThinkingEngineer $you)
{
    $question = new Question($you->problems);
    $you->postQuestion($question);
    while (!$question->resolved) {
        $answers = $you->getAnsweres();
        if ($you->resolveQuestion($answers)) {
            $you->appreciate("Thank you!");
            break;
        }
    }
    return $you->evolve();
}'
	];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Comment::class, function(Faker\Generator $faker) {
	return [
		'body' => $faker->paragraph
	];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Tag::class, function(Faker\Generator $faker) {
	$name = $faker->word;

	return [
		'name' => $name,
		'slug' => str_slug($name)
	];
});