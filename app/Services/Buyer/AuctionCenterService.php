<?php

namespace App\Services\Buyer;

use App\Models\Bid;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuctionCenterService
{
    public function showAuctionCenterAndProducts()
    {
        $products = Product::where('is_available',1)
            ->orderBy('created_at','desc')
            ->paginate(15);

        return view('buyer.auction_center.index',compact('products'));
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

        Bid::create([
            'product_id' => $bidInfo['product_id'],
            'user_id' => Auth::user()->getAuthIdentifier(),
            'bid_price' => $bidInfo['bid_price'],
            'bid_comment' => $bidInfo['bid_comment'],
        ]);

        return Redirect::back()->with('success', "Bid placed successfully");
    }
}
