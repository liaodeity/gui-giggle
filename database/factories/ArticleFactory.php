<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Addons\Article\Models\Article;
use App\Addons\Category\Models\Category;
use Faker\Generator as Faker;

$factory->define (Article::class, function (Faker $faker) {
    return [
        'category_id' => Category::orderByRaw('rand()')->first(),
		'title' => $faker->text(200),
		'cover_id' => 0,
		'sub_title' => $faker->text(100),
		'source' => $faker->text(100),
		'source_link' => $faker->text(150),
		'view_number' => $faker->randomNumber (),
		'is_top' => $faker->randomElement ([1, 2, 3]),
		'description' => $faker->text(500),
		'content' => $faker->text,
		'release_at' => $faker->dateTimeBetween (),
		'user_id' => \App\Addons\User\Models\User::orderByRaw('rand()')->first(),
		'status' => $faker->randomElement ([1, 2, 3]),

    ];
});
