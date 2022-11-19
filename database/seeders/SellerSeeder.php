<?php

namespace Database\Seeders;

use App\Constants\AppConstants;
use App\Models\Seller;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::truncate();
        $faker = Faker::create('App\Seller');
        for ($i = 1; $i <=400;$i++)
        {
            DB::table('sellers')->insert([
                'full_name' => $faker->firstName().' '.$faker->lastName(),
                'phone_number' => $faker->phoneNumber(),
                'email' => $faker->email(),
                'location' => $faker->city(),
                'rating' => $faker->numberBetween(20,1000),
                'created_at'=> Carbon::now(AppConstants::$time_zone)->format(AppConstants::$time_format)
            ]);
        }
    }
}
