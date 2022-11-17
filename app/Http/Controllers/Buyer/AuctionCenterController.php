<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Services\Buyer\AuctionCenterService;
use App\Services\Buyer\BiddingService;
use Illuminate\Http\Request;

class AuctionCenterController extends Controller
{
    /**
     * @var AuctionCenterService
     */
    private $_auctionCenterService;
    /**
     * @var BiddingService
     */
    private $_biddingService;

    public function __construct(AuctionCenterService $auctionCenterService, BiddingService $biddingService)
    {
        $this->_auctionCenterService = $auctionCenterService;
        $this->_biddingService = $biddingService;
    }

    /**
     * Show auctioned products page
     */
    public function showAuctionCenter()
    {
//        return $this->_biddingService->checkIfProductHasBids();
        return $this->_biddingService->checkBiddingStatus();
//        return $this->_auctionCenterService->showAuctionCenterAndProducts();
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
}
