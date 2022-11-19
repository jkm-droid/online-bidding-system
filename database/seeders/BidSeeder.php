<?php

namespace Database\Seeders;

use App\Constants\AppConstants;
use App\Models\Bid;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bid::truncate();
        $faker = Faker::create('App\Bid');
        for ($i = 1; $i <=7000;$i++)
        {
            $product_id = Product::where('has_bid',1)->pluck('id')->random();
            $user_id = User::pluck('id')->random();
            DB::table('bids')->insert([
                'product_id' => $product_id,
                'user_id' => $user_id,
                'bid_price' => $faker->numberBetween(10000,100000),
                'bid_comment' => $faker->word(),
                'created_at' => Carbon::now(AppConstants::$time_zone),
                'expires_at' => Product::where('id',$product_id)->pluck('expires_at')
            ]);
        }
    }
}
