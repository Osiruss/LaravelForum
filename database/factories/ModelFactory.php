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

/*$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->username,
        'email' => $faker->email,
        'password' => bcrypt('password'),
        'remember_token' => str_random(10),
    ];
});

$users = \App\User::all()->lists('id');

$factory->define(App\Thread::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomElement($users),
        'forum_id' => $faker->numberBetween(1,5),
        'title' => $faker->sentence(6),
        'slug' => $faker->slug
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,50),
        'thread_id' => $faker->numberBetween(1,5),
        'post' => $faker->paragraphs(mt_rand(1,3))
    ];
});*/