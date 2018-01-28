<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Seller;
use Faker\Factory;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    $sellers = Seller::has('products')->get();
    	$buyers = User::all();

        //
        $faker = Factory::create();

        $limit = 200;

        $transactions = [];

        for ($i = 0; $i < $limit; $i++) {

        	$seller = $sellers->random();

        	$transactions[] = [
		        'quantity' => $faker->numberBetween(1, 8),
		        'buyer_id' => $buyers->except($seller->id)->random()->id,
		        'product_id' => $seller->products->random()->id,
        	];
        }
        DB::table('transactions')->insert($transactions);
    }
}
