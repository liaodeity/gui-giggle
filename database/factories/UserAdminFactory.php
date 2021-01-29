<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define (\App\Addons\User\Models\UserAdmin::class, function (Faker $faker) {
    return [
        'user_id' => \App\Addons\User\Models\User::orderByRaw('rand()')->value('id'),
		'username' => $faker->text(50),
		'password' => $faker->text(128),
		'status' => $faker->randomElement ([1, 2, 3]),

    ];
});
