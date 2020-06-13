<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Blog;
use App\ProductColor;
use App\ProductSize;
use App\Category;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // factory(Category::class , 10 )->create();
        // factory(Product::class , 10 )->create();
            factory(Blog::class , 10 )->create();
        // factory(ProductColor::class , 102 )->create();
        // factory(ProductSize::class , 2 )->create();
    }
}
