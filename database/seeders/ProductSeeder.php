<?php

namespace Database\Seeders;

use App\Models\Seller;
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
        $faker = Faker::create('App\Product');
        $seller_id = Seller::pluck('id')->random();
        for ($i = 1; $i <=10000;$i++)
        {
            $image = $faker->image(public_path('product_gallery'), 400, 400, null, false);
            DB::table('products')->insert([
                'product_name' => $faker->word(),
                'seller_id' => $seller_id,
                'price' => $faker->numberBetween(5000,100000),
                'specs' => $faker->city(),
                'product_image' => $image,
                'is_available' => $faker->randomElement(['1','0'])
            ]);
        }
    }
}
