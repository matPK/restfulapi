<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $limit = 20;

        $users = [];

        for ($i = 0; $i < $limit; $i++) {

        	$verified = $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]);
        	$now = Date('Y-m-d H:i:s', time());

        	$users[] = [
		        'name' => $faker->name,
		        'email' => $faker->unique()->safeEmail,
		        'password' => bcrypt($faker->word),
		        'remember_token' => str_random(10),
		        'verified' => $verified,
		        'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationToken(),
		        'admin' => $faker->randomElement([User::ADMIN_USER, User::REGULAR_USER]),
		        'created_at' => $now,
		        'updated_at' => $now,
        	];
        }
        DB::table('users')->insert($users);
    }
}
