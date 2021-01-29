<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define (\App\Addons\Category\Models\Category::class, function (Faker $faker) {
    return [
        'pid' => 0,
		'link_name' => $faker->text(20),
		'banner_id' => 0,
		'title' => $faker->text(100),
		'sub_title' => $faker->text(150),
		'url' => $faker->word,//url需要其他模块支持
		'module' => $faker->randomElement(['App\Models\Article\Article','App\Models\Goods\Goods']),
		'template' => $faker->text(50),
		'sort' => $faker->numberBetween (1, 99),
		'status' => $faker->randomElement ([1, 2, 3]),
		'user_id' => 0,

    ];
});
