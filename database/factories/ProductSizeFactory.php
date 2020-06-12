<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProductSize;
use App\Product;
use Faker\Generator as Faker;

$factory->define(ProductSize::class, function (Faker $faker) {
    $products = Product::all()->pluck('id');
    $sizes = ['XXS' , 'XS' , 'S' , 'M' , 'L' , 'XL' , 'XXL' , 'XXXL' ];
    return [
        'product_id'=>$faker->randomElement($products) ,
        'size'=>$faker->randomElement($sizes)
    ];
});
