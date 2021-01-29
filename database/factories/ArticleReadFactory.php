<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define (\App\Addons\Article\Models\ArticleRead::class, function (Faker $faker) {
    return [
        'article_id' => 0,
		'view_at' => $faker->dateTimeBetween (),
		'user_id' => 0,

    ];
});
