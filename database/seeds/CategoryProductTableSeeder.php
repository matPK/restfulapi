<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;
use Faker\Factory;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $category_product = [];

        $products = Product::all();
        $categories = Category::all();

        foreach ($products as $product) {
        	$categories_ids = $categories->random($faker->numberBetween(2, 5))->pluck('id');
        	$product->categories()->sync($categories_ids);
        }
        //DB::table('category_product')->insert($category_product);
    }
}
