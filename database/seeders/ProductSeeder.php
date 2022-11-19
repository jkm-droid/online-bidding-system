<?php

namespace Database\Seeders;

use App\Constants\AppConstants;
use App\Models\Product;
use App\Models\Seller;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        $faker = Faker::create('App\Product');
        for ($i = 1; $i <=3000;$i++)
        {
            $image = $faker->randomElement([
                'animi_2022_11_16_18_36_10.jpg',
                'Dell_2022_11_16_18_35_11.jpg',
                'lenovo_thinkpad_2022_11_16_18_17_28.jpg',
                'Samsung_2022_11_16_18_06_28.jpg',
                'Samsung_laptop_2022_11_16_18_00_10.jpg',
                'laptop_1.jpg',
                'laptop_2.png',
                'laptop_3.jpg',
                'laptop_4.jpeg',
                'laptop_5.png',
                'laptop_6.jpg',
                'laptop_7.jpg',
                'laptop_8.jpg',
                'laptop_9.jpeg',
                'laptop_10.jpeg'
            ]);
            $seller_id = Seller::pluck('id')->random();
            $creat_time = Carbon::now(AppConstants::$time_zone)->format('Y-m-d H:i:s');
            DB::table('products')->insert([
                'product_name' => $faker->word(),
                'seller_id' => $seller_id,
                'price' => $faker->numberBetween(30000,70000),
                'specs' => $faker->word().','.$faker->word().','.$faker->word().','.$faker->word(),
                'is_available' => 1,
                'created_at' => $creat_time,
                'product_image' => $image,
                'has_bid' => $faker->randomElement([1,0]),
                'expires_at' => Carbon::createFromFormat(AppConstants::$time_format,$creat_time)->addMinutes(AppConstants::$product_duration),
            ]);
        }
    }
}
