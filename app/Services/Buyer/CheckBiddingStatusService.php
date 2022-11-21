<?php

namespace App\Services\Buyer;

use App\Constants\AppConstants;
use App\Helpers\ServiceHelpers;
use App\Models\Bid;
use App\Models\Product;
use Carbon\Carbon;

class CheckBiddingStatusService
{
    /**
     * check the product and bid expiration, if expires_at < 10 mins,
     * choose the highest bidder mark product as sold out
     */
    public function checkBiddingStatus()
    {
        ServiceHelpers::add_to_file('[BID_STATUS]Started checking bid status at '.Carbon::now());

        //get only the bidded products' ids
        $product_with_bids = Product::where('has_bid',1)->get();
        if ($product_with_bids){
            //get a specific product bids
            foreach ($product_with_bids as $product_with_bid)
            {
                $product_time_diff = ServiceHelpers::timeDifference($product_with_bid->created_at);
                $remaining_time = AppConstants::$product_duration - $product_time_diff;

                $exp_time = AppConstants::$product_duration;
                $check = $product_time_diff <= $exp_time && $product_time_diff > 0;

                if ($check == true && $remaining_time <= 10)
                {
                    if ($product_with_bid->bids->count() > 1)
                    {
                        $multiple_bid_details= $this->getBidPricesForProductWithManyBids($product_with_bid->bids);
                        $highest_bid_price = $multiple_bid_details['max_bid_price'];
                        $highest_bid_price_id = $multiple_bid_details['max_bid_id'];
                        $this->markProductAsOwned(
                            $highest_bid_price,
                            $highest_bid_price_id,
                            $product_with_bid);
                    }else
                    {
                        $highest_bid_price = $this->getBidPriceForProductWithSingleBid($product_with_bid->bids[0]);
                        $this->markProductAsOwned(
                            $highest_bid_price,
                            $product_with_bid->bids[0]->id,
                            $product_with_bid);
                    }
                }
                elseif($product_time_diff > $exp_time)
                {
                    ServiceHelpers::closedTheProductForBidding($product_with_bid->id);
                }
            }
        }
    }

    private function markProductAsOwned($max_bid_price, $bid_id, $product)
    {
        if ($product->price < $max_bid_price)
        {
            Bid::where('id',$bid_id)->update([
                'is_success' => 1,
                'bidded_at' => Carbon::now(AppConstants::$time_zone)
            ]);

            ServiceHelpers::closedTheProductForBidding($product->id);
        }
    }

    private function getBidPricesForProductWithManyBids($multiple_bids)
    {
        $multiple_price_array = [];
        foreach ($multiple_bids as $multiple_bid)
        {
            $details = [];
//            $time_diff = ServiceHelpers::timeDifference($multiple_bid->created_at);
//            if ($time_diff < AppConstants::$bid_duration) {
            $details['id'] = $multiple_bid->id;
            $details['bid_price'] = $multiple_bid->bid_price;
            array_push($multiple_price_array, $details);
//            }
        }

        $bid_prices = array_column($multiple_price_array,'bid_price');
        $max_bid_id = 0;
        $max_price = max($bid_prices);
        foreach($multiple_price_array as $item)
        {
            if ($max_price == $item['bid_price']){
                $max_bid_id = $item['id'];
            }
        }

        return array('max_bid_id' => $max_bid_id,'max_bid_price'=>$max_price);
    }

    private function getBidPriceForProductWithSingleBid($single_bid)
    {
        $bid_price = 0;
//        $time_diff = ServiceHelpers::timeDifference($single_bid->created_at);
//        if ($time_diff < AppConstants::$bid_duration)
//        {
        $bid_price = $single_bid->bid_price;
//        }

        return $bid_price;
    }
}
