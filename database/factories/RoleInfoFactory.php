<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define (\App\Addons\Role\Models\RoleInfo::class, function (Faker $faker) {
    return [
        'role_id' => $faker->randomNumber (),
		'name' => $faker->text(50),
		'desc' => $faker->text,
		'role_value' => $faker->text,
		'status' => $faker->randomElement ([1, 2, 3]),
		'user_id' => 0,

    ];
});
