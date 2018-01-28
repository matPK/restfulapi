<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $limit = 8;

        $categories = [];

        for ($i = 0; $i < $limit; $i++) {
        	$categories[] = [
		        'name' => $faker->unique()->word,
		        'description' => $faker->paragraph(mt_rand(1, 5)),
        	];
        }
        DB::table('categories')->insert($categories);
    }
}
