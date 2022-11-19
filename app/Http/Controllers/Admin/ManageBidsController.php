<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ManageBidsService;
use App\Services\Admin\ManageProductsService;
use Illuminate\Http\Request;

class ManageBidsController extends Controller
{
    /**
     * @var ManageBidsService
     */
    private $_bidsService;

    public function __construct(ManageBidsService $bidsService)
    {
        $this->middleware('auth:admin');
        $this->_bidsService = $bidsService;
    }

    /**
     * Get all bids
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getSystemBids()
    {
        return $this->_bidsService->getAllBids();
    }

    /**
     * Get all succeeded bids
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getSuccessfulBids()
    {
        return $this->_bidsService->getSucceededBids();
    }
}
