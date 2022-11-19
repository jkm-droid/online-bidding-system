<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Services\Buyer\AuctionCenterService;
use App\Services\Buyer\CheckBiddingStatusService;
use Illuminate\Http\Request;

class AuctionCenterController extends Controller
{
    /**
     * @var AuctionCenterService
     */
    private $_auctionCenterService;

    public function __construct(AuctionCenterService $auctionCenterService)
    {
        $this->middleware('auth');
        $this->_auctionCenterService = $auctionCenterService;
    }

    /**
     * Show auctioned products page
     */
    public function showAuctionCenter()
    {
        return $this->_auctionCenterService->showAuctionCenterAndProducts();
    }

    /**
     * Place a bid
     *
     * @param Request $request
     */
    public function placeProductBid(Request $request)
    {
        return $this->_auctionCenterService->savePlacedBid($request);
    }

    /***
     * Get all bids belonging to a buyer
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getBuyersBids()
    {
        return $this->_auctionCenterService->getBuyerBids();
    }
}
