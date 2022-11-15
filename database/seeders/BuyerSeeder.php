<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\Buyer');
        for ($i = 1; $i <=1000;$i++)
        {
            $image = $faker->image(public_path('profile_pictures'), 400, 400, null, false);

            DB::table('users')->insert([
                'username' => $faker->userName(),
                'full_name' => $faker->firstName().' '.$faker->lastName(),
                'phone_number' => $faker->phoneNumber(),
                'email' => $faker->email(),
                'password' => Hash::make("jkmq1234")
            ]);
        }
    }
}
