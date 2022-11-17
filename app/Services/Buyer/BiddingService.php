<?php

namespace App\Services\Buyer;

use App\Models\Product;

class BiddingService
{
    //In the case where the set amount is not reached or
    // no one bidded the bidding is considered as unsuccessful
    public function checkBiddingStatus()
    {
        $productIds = Product::pluck('id');

        foreach ($productIds as $productId){

        }
    }
}
