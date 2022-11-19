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
        $similarProducts = Product::all();

        $duplicates = DB::table('products')
            ->select('product_name', (DB::raw('COUNT(product_name) as product_count')))
            ->groupBy('product_name')
            ->having(DB::raw('COUNT(product_name)'), '>', 1)
            ->get();

        $similar_name = '';
        $dup_count = [];
        //add the count to an array
        foreach ($duplicates as $duplicate)
        {
            array_push($dup_count,$duplicate->product_count);
        }
        //choose the product_name to use
        foreach ($duplicates as $duplicate)
        {
            $random_key = array_rand($dup_count,1);
            if($duplicate->product_count == $dup_count[$random_key]){
                $similar_name = $duplicate->product_name;
            }
        }

        //get the similar products
        $similarProducts = $similarProducts->where('product_name',$similar_name);

        $products = Product::where('product_name','!=',$similar_name)->paginate(10);

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
            'bid_comment' => $bidInfo['bid_comment']
        ]);

        return Redirect::back()->with('success', "Bid placed successfully");
    }

    public function getBuyerBids()
    {
        $bids = Bid::where('user_id',Auth::user()->getAuthIdentifier())->paginate(15);
        return view('buyer.bids.index', compact('bids'));
    }
}
