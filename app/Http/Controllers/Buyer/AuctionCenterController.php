<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Services\Buyer\AuctionCenterService;
use App\Services\Buyer\CheckBiddingStatusService;
use App\Services\Buyer\CheckProductStatusService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuctionCenterController extends Controller
{
    /**
     * @var AuctionCenterService
     */
    private $_auctionCenterService;
    /**
     * @var CheckBiddingStatusService
     */
    private $_biddingStatusService;
    /**
     * @var CheckProductStatusService
     */
    private $_service;

    public function __construct(AuctionCenterService $auctionCenterService, CheckBiddingStatusService $biddingStatusService, CheckProductStatusService $service)
    {
        $this->middleware('auth');
        $this->_auctionCenterService = $auctionCenterService;
        $this->_biddingStatusService = $biddingStatusService;
        $this->_service = $service;
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
     * @return Application|Factory|View
     */
    public function getBuyersBids()
    {
//        return $this->_service->checkIfProductHasBids();
//        return $this->_biddingStatusService->checkBiddingStatus();
        return $this->_auctionCenterService->getBuyerBids();
    }

    /***
     * Get all products the buyer has placed a bid
     *
     * @return Application|Factory|View
     */
    public function getBuyersBidProducts()
    {
        return $this->_auctionCenterService->getBuyerBidProducts();
    }
}
