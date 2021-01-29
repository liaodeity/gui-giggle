<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define (\App\Addons\User\Models\Admin::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'password' => '123456',
        'status'   => $faker->randomElement ([1, 4])
    ];
});
