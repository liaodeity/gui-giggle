<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define (\App\Addons\Parameter\Models\Parameter::class, function (Faker $faker) {
    return [
        'name' => $faker->text(100),
		'model' => $faker->text(200),
		'title' => $faker->text(200),

    ];
});
