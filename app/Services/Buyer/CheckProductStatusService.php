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
        $file = fopen(Storage::disk('local')->path('check_product_status.log'), 'a+');
        fwrite($file,'Started checking product status at '.Carbon::now()."\n");
        fclose($file);

        //get all the products
        $products = Product::all('id','created_at','has_bid','is_closed','price');
        foreach ($products as $product)
        {
            $time_diff = ServiceHelpers::timeDifference($product->created_at);

            //In case where no one bid the bidding is
            // considered as unsuccessful(closed)
            if ($product->has_bid == 0 && $time_diff > AppConstants::$product_expiration )
            {
                ServiceHelpers::closedTheProductForBidding($product->id);
            }

            //In the case where the set amount is not reached,
            //the bidding is considered as unsuccessful(closed)
            if ($product->has_bid == 1 && $time_diff < AppConstants::$product_expiration ){
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
            //delete all bids associated with the product
            foreach ($bids as $product_bid)
            {
                Bid::where('id',$product_bid->id)->update([
                    'has_expired' => 1,
                    'expired_at' => Carbon::now()
                ]);
            }
        }
    }
}
