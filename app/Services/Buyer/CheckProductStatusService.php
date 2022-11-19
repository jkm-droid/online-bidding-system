<?php

namespace App\Services\Buyer;

use App\Constants\AppConstants;
use App\Helpers\ServiceHelpers;
use App\Models\Bid;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class CheckProductStatusService
{
    /**
     * In case where no one bid the bidding is
     * considered as unsuccessful(closed)     *
     * In the case where the set amount is not reached,
     *the bidding is considered as unsuccessful(closed)
     */
    public function checkIfProductHasBids()
    {
        ServiceHelpers::add_to_file("[PRODUCT_STATUS]Started checking product status at ".Carbon::now());

        //get all the products
        $products = Product::all('id','created_at','has_bid','is_closed','price');
        foreach ($products as $product)
        {
            $time_diff = ServiceHelpers::timeDifference($product->created_at);
            $duration = AppConstants::$product_duration;

            //In case where no one bid the bidding is
            // considered as unsuccessful(closed)
            if ($product->has_bid == 0 && $time_diff > $duration)
            {
                ServiceHelpers::closedTheProductForBidding($product->id);
            }

            //In the case where the set amount is not reached,
            //the bidding is considered as unsuccessful(closed)
            $remaining_time = $duration - $time_diff;
            if ($product->has_bid == 1 && $time_diff < $duration && $remaining_time <= 10 ){
                $this->checkIfProductBidPriceIsReached($product);
            }

        }
    }

    private function checkIfProductBidPriceIsReached($product)
    {
        //get all bids belonging to the product
        $bids = $product->bids;

        //count bids with lower bid_price than the product_price
        $count = 0;
        foreach ($bids as $product_bid)
        {
            if ($product_bid->bid_price <= $product->price){
                $count = $count + 1;
            }
        }

        //mark the product as closed
        if ($count > 0){
            ServiceHelpers::closedTheProductForBidding($product->id);
            //close all bids associated with the product
            foreach ($bids as $product_bid)
            {
                $bid = Bid::where('id',$product_bid->id)->first();
                $bid->has_expired = 1;
                $bid->expired_at = Carbon::now(AppConstants::$time_zone)->format(AppConstants::$time_format);
                $bid->update();
                $data = "Closed the bid with Id: ".$bid->id.' at '.$bid->updated_at;
                ServiceHelpers::add_to_file($data);
            }
        }
    }
}
