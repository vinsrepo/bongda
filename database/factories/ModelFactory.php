<?php

use App\Models\User;
use App\Models\CategoryNews;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'address' => $faker->address,
        'phone' => (string) $faker->numberBetween($min = 100000000, $max = 999999999),
        'avatar' => $faker->imageUrl($width = 640, $height = 480),
        'password' => '$2y$12$jizLtjVYB6ZLJvwEdnlUa.ULJ2I18Siy.Uz3E5.w4Zcx5VE/FYKb2', // 123456
        'remember_token' => Str::random(10),
    ];
});

$factory->define(CategoryNews::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->slug,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2)
    ];
});

$factory->define(\App\Models\News::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'slug' => $faker->slug,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'content' => $faker->realText($maxNbChars = 400, $indexSize = 2)
    ];
});

