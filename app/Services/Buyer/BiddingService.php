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

    public function checkBiddingStatus()
    {
        //get only the bidded products' ids
        $productWithBids = Product::where('has_bid',1)->get();

        //get the bids' ids
        $bids = array();
        foreach ($productWithBids as $productWithBid)
        {
            $productTimeDiff = $this->timeDifference($productWithBid->created_at);
            if ($productTimeDiff < AppConstants::$product_expiration)
            {
                $bidForProduct = Bid::where('product_id', $productWithBid->id)
                    ->first();
                array_push($bids,$bidForProduct);
            }
            else
            {
                $this->closedTheProductForBidding($productWithBid->id);
            }
        }
        dd($bids);
        //check the product and bid expiration, if expires_at < 10 mins, choose the highest bidder
        //mark product as sold out

    }

    public function checkIfProductHasBids()
    {
        //get all the products
        $products = Product::all('id','created_at','has_bid','is_closed','price');
        foreach ($products as $product)
        {
            $timeDiff = $this->timeDifference($product->created_at);

            //In case where no one bidded the bidding is
            // considered as unsuccessful(closed)
            if ($product->has_bid == 0 && $timeDiff > AppConstants::$product_expiration )
            {
                $this->closedTheProductForBidding($product->id);
            }
            //In the case where the set amount is not reached,
            //the bidding is considered as unsuccessful(closed)
            if ($product->has_bid == 1 && $timeDiff < AppConstants::$product_expiration ){
                $this->checkIfProductBidPriceIsReached($product->id, $product->price);
            }

        }
    }

    private function checkIfProductBidPriceIsReached($product_id, $product_price)
    {
        //get all bids belonging to the product
        $bids = Bid::where('product_id',$product_id)->get();

        //count bids with lower bid_price that the product_price
        $count = 0;
        foreach ($bids as $product_bid)
        {
            if ($product_bid->bid_price <= $product_price){
                $count = $count + 1;
            }
        }
        //mark the product as closed
        if ($count > 0){
            $this->closedTheProductForBidding($product_id);
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
        $createDate = Carbon::createFromFormat('Y-m-d H:s:i', $time);
        $nowDate = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());

        return $nowDate->diffInHours($createDate);
    }

}
