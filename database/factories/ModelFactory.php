<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'id' => $faker->unique()->randomDigit,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Society::class, function (Faker\Generator $faker) {

    return [
        'id' => $faker->unique()->randomDigit,
        'name' => $faker->name,
        'catagory' => $faker->realText,
    ];
});

$factory->define(App\UserSociety::class, function (Faker\Generator $faker) {

    return [
        'user_id' => $faker->unique()->randomDigit,
        'society_id' => $faker->unique()->randomDigit,
    ];
});

$factory->define(App\Discussion::class, function (Faker\Generator $faker) {

    return [
        'id' => $faker->unique()->randomDigit,
        'quarter' => $faker->realText,
        'society_id' => $faker->unique()->randomDigit,
        'year'=> $faker->unique()->randomDigit,
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {

    return [
        'post_id' => $faker->unique()->randomDigit,
        'title' => $faker->realText,
        'content' => $faker->realText,
        'has_link' => $faker->boolean,
        'link' => $faker->realText,
        'discussion_id' => $faker->unique()->randomDigit,
        'user_id' => $faker->unique()->randomDigit,
        'user_name' => $faker->realText,
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {

    return [
        'id' => $faker->unique()->randomDigit,
        'post_id' => $faker->unique()->randomDigit,
        'commenter_id' => $faker->unique()->randomDigit,
        'commenter_name' => $faker->realText,
        'content' => $faker->realText,
    ];
});