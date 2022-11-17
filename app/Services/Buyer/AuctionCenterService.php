<?php

namespace App\Services\Buyer;

use App\Models\Bid;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AuctionCenterService
{
    public function showAuctionCenterAndProducts()
    {
        $similarProducts = Product::whereIn('product_name', function ( $query ) {
            $query->select('product_name')->from('products')->groupBy('product_name')->havingRaw('count(*) > 1');
        })->get();

        $product_name = '';
        foreach($similarProducts as $similarProduct){
           $product_name = $similarProduct->product_name;
        }

        $products = Product::where('product_name','!=',$product_name)->paginate(10);

        return view('buyer.auction_center.index',compact('products','similarProducts'));
    }

    public function savePlacedBid($bidRequest)
    {
        $bidRequest->validate([
            'bid_price' => 'required',
            'bid_comment' => 'string',
        ]);

        $bidInfo = $bidRequest->all();
        //check if buyer already has a bid with similar bid price
        $similarBid = Bid::where('user_id',Auth::user()->getAuthIdentifier())
            ->where('product_id', $bidInfo['product_id'])
            ->where('bid_price', $bidInfo['bid_price'])
            ->first();

        if ($similarBid)
            return Redirect::back()->with('error', 'A similar bid exists');

        //update product bidding status
        Product::where('id',$bidInfo['product_id'])->update([
            'has_bid' => 1
        ]);

        Bid::create([
            'product_id' => $bidInfo['product_id'],
            'user_id' => Auth::user()->getAuthIdentifier(),
            'bid_price' => $bidInfo['bid_price'],
            'bid_comment' => $bidInfo['bid_comment'],
            'expires_at' => Carbon::now()->addHours(24)
        ]);

        return Redirect::back()->with('success', "Bid placed successfully");
    }
}
