<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\User;
use Faker\Factory;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        $limit = 50;

        $products = [];

        $users = User::all();

        for ($i = 0; $i < $limit; $i++) {
        	$products[] = [
		        'name' => $faker->word,
		        'description' => $faker->paragraph(1),
		        'quantity' => $faker->numberBetween(1, 10),
		        'status' => $faker->randomElement([Product::AVAILABLE_PRODUCT, Product::UNAVAILABLE_PRODUCT]),
		        'image' => $faker->randomElement([
		            '1502242_z_small.jpg',
		            'galaxy-s7-angle-100642599-large.jpg',
		            'samsung-z3-470x310@2x.jpg',
		        ]),
		        'seller_id' => $users->random()->id,
        	];
        }
        DB::table('products')->insert($products);
    }
}
