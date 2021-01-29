<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define (\App\Addons\Plugin\Models\Plugin::class, function (Faker $faker) {
    return [
        'name' => 0,
		'version' => $faker->text(100),
		'title' => $faker->text(100),
		'cover_img' => $faker->text(100),
		'content' => $faker->text,
		'depend' => $faker->text,
		'file_tree' => $faker->text,
		'is_install' => $faker->randomElement ([1, 2, 3]),
		'is_update' => $faker->randomElement ([1, 2, 3]),
		'install_at' => $faker->dateTimeBetween (),
		'user_id' => 0,
		'deleted_at' => $faker->dateTimeBetween (),

    ];
});
