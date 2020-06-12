<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductColor;
use App\Product;
use Faker\Generator as Faker;

$factory->define(ProductColor::class, function (Faker $faker) {
    $products = Product::all()->pluck('id');
    return [
        'product_id' =>$faker->randomElement($products),
        'color' =>$faker->colorName(),
    ];
});
