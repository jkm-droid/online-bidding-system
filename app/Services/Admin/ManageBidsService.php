<?php

namespace App\Services\Admin;

use App\Constants\AppConstants;
use App\Models\Bid;

class ManageBidsService
{
    public function getAllBids()
    {
        $bids = Bid::paginate(AppConstants::$pagination);

        return view('admin.all-bids.index', compact('bids'));
    }

    public function getSucceededBids()
    {
        $bids = Bid::where('is_success',1)->paginate(AppConstants::$pagination);

        return view('admin.all-bids.success-bids', compact('bids'));
    }
}
