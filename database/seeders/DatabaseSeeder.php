<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//       $this->call(BuyerSeeder::class);
//       $this->call(SellerSeeder::class);
//       $this->call(ProductSeeder::class);
       $this->call(BidSeeder::class);
    }
}
