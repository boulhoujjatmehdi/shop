<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use App\User;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    $users = User::all()->pluck('id');
    return [
        'title'=>$faker->realText(50),
        'content'=>$faker->realText(800),
        'user_id'=>$faker->randomElement($users)
    ];
});
