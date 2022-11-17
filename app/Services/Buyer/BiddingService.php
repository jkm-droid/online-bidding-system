<?php

namespace App\Services\Buyer;

use App\Constants\AppConstants;
use App\Models\Bid;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Nette\Utils\DateTime;

class BiddingService
{

    /**
     * check the product and bid expiration, if expires_at < 10 mins,
     * choose the highest bidder mark product as sold out
     */
    public function checkBiddingStatus()
    {
        //get only the bidded products' ids
        $product_with_bids = Product::where('has_bid',1)->get();

        //get a specific product bids
        foreach ($product_with_bids as $product_with_bid)
        {
            $product_time_diff = $this->timeDifference($product_with_bid->created_at);
            if ($product_time_diff < AppConstants::$product_expiration)
            {
                if ($product_with_bid->bids->count() > 1)
                {
                    $highest_bid_price = $this->getBidPricesForProductWithManyBids($product_with_bid->bids);
                    $this->markProductAsOwned($highest_bid_price,$product_with_bid->bids);
                }else
                {
                    $highest_bid_price = $this->getBidPriceForProductWithSingleBid($product_with_bid->bids[0]);
                    $this->markProductAsOwned($highest_bid_price,$product_with_bid);
                }
            }
            else
            {
                $this->closedTheProductForBidding($product_with_bid->id);
            }
        }

    }

    private function markProductAsOwned($max_bid_price, $product_with_bid)
    {
        dd($product_with_bid->bids->where('bid_price',$highest_bid_price)->where('product_id',$product_with_bid->id));
        if ($product_with_bid->price < $max_bid_price)
        {

        }
    }


    private function getBidPricesForProductWithManyBids($multiple_bids)
    {
        $multiple_price_array = [];
        foreach ($multiple_bids as $multiple_bid)
        {
            $time_diff = $this->timeDifference($multiple_bid->created_at);
            if ($time_diff < AppConstants::$bid_expiration) {
                array_push($multiple_price_array, $multiple_bid->bid_price);
            }
        }

        return max($multiple_price_array);
    }


    private function getBidPriceForProductWithSingleBid($single_bid)
    {
        $bid_price = 0;
        $time_diff = $this->timeDifference($single_bid->created_at);
        if ($time_diff < AppConstants::$bid_expiration)
        {
            $bid_price = $single_bid->bid_price;
        }

        return $bid_price;
    }

    /**
     * In case where no one bidded the bidding is
     * considered as unsuccessful(closed)     *
     * In the case where the set amount is not reached,
     *the bidding is considered as unsuccessful(closed)
     */
    public function checkIfProductHasBids()
    {
        //get all the products
        $products = Product::all('id','created_at','has_bid','is_closed','price');
        foreach ($products as $product)
        {
            $time_diff = $this->timeDifference($product->created_at);

            //In case where no one bidded the bidding is
            // considered as unsuccessful(closed)
            if ($product->has_bid == 0 && $time_diff > AppConstants::$product_expiration )
            {
                $this->closedTheProductForBidding($product->id);
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

        //count bids with lower bid_price that the product_price
        $count = 0;
        foreach ($bids as $product_bid)
        {
            if ($product_bid->bid_price <= $product->price){
                $count = $count + 1;
            }
        }

        //mark the product as closed
        if ($count > 0){
            $this->closedTheProductForBidding($product->id);
            //delete all bids associated with the product
            foreach ($bids as $product_bid)
            {
                Bid::where('id',$product_bid->id)->delete();
            }
        }
    }

    private function closedTheProductForBidding($product_id)
    {
        Product::where('id',$product_id)->update([
            'is_closed' => 1
        ]);
    }

    private function timeDifference($time)
    {
        $create_date = Carbon::createFromFormat('Y-m-d H:s:i', $time);
        $now_date = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());

        return $now_date->diffInHours($create_date);
    }
}
