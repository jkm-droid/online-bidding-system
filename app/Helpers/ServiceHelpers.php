<?php

namespace App\Helpers;

use App\Models\Product;
use Carbon\Carbon;

class ServiceHelpers
{
    public static function closedTheProductForBidding($product_id)
    {
        Product::where('id',$product_id)->update([
            'is_closed' => 1
        ]);
    }

    public static function timeDifference($time)
    {
        $create_date = Carbon::createFromFormat('Y-m-d H:s:i', $time);
        $now_date = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::now());

        return $now_date->diffInHours($create_date);
    }
}
