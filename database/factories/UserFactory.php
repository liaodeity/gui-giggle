<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define (\App\Addons\User\Models\User::class, function (Faker $faker) {
    return [
        'user_no'  => $faker->creditCardNumber (),
        'mobile'   => $faker->phoneNumber,
        'nickname' => $faker->name,
        'password' => \Illuminate\Support\Facades\Hash::make ('123456'), // password
        'birthday' => $faker->date (),
        'gender'   => $faker->randomElement ([1, 2]),
        'reg_date' => $faker->date ()
    ];
});
