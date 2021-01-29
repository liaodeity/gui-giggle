<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define (\App\Models\SystemGui\Attachment::class, function (Faker $faker) {
    return [
        'uuid' => 0,
		'path' => $faker->text(200),
		'title' => $faker->text(100),
		'md5' => $faker->text(32),
		'sha1' => $faker->text(42),
		'mine_type' => $faker->text(100),
		'suffix' => $faker->text(10),
		'size' => $faker->randomNumber (),
		'use_number' => $faker->randomNumber (),
		'last_at' => $faker->dateTimeBetween (),
		'status' => $faker->randomElement ([1, 2, 3]),
		'user_id' => 0,
		'access_type' => $faker->text(255),
		'access_id' => 0,
		'deleted_at' => $faker->dateTimeBetween (),

    ];
});
