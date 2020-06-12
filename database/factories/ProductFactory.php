<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $categories = Category::all()->pluck('id');
    return [
        'title'=>$faker->realText(50),
        'price'=>$faker->randomFloat(4 , 1 , 9999),
        'size'=>$faker->randomFloat(2,1,9999),
        'color'=>$faker->colorName(),
        'description'=>$faker->realText(),
        'additional_info'=>$faker->realText(),
        'stock'=>$faker->numberBetween(0 , 10000),
        'categorie_id'=>$faker->randomElement($categories)
                
    ];
});
