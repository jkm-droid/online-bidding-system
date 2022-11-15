<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Services\Buyer\AuctionCenterService;
use Illuminate\Http\Request;

class AuctionCenterController extends Controller
{
    /**
     * @var AuctionCenterService
     */
    private $_auctionCenterService;

    public function __construct(AuctionCenterService $auctionCenterService)
    {
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
}
