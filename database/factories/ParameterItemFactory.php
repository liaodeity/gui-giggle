<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define (\App\Addons\Parameter\Models\ParameterItem::class, function (Faker $faker) {

    return [
        'parameter_id' => 0,
		'key' => $faker->randomElement ([1, 2, 3]),
		'item' => $faker->text(191),
		'status' => $faker->randomElement ([1, 2, 3]),
		'color' => $faker->text(50),
		'sort' => $faker->numberBetween (1, 10000),

    ];
});
