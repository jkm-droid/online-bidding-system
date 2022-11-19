<?php

namespace App\Helpers;

use App\Constants\AppConstants;
use App\Models\Product;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Storage;

class ServiceHelpers
{
    public static function closedTheProductForBidding($product_id)
    {
        $product = Product::where('id',$product_id)->first();
        $product->is_closed = 1;
        $product->update();

        $data = "Closed the product with Id: ".$product->id.' at '.$product->updated_at;
        self::add_to_file($data);
    }

    public static function timeDifference($create_time)
    {
        $create_date = Carbon::createFromFormat( AppConstants::$time_format,$create_time);
        $now_date = Carbon::createFromFormat(AppConstants::$time_format,Carbon::now(AppConstants::$time_zone));

//        dd($now_date);
//        dd($now_date->diffInMinutes($create_date));
        return $now_date->diffInMinutes($create_date);
    }

    public static function add_to_file(string $string)
    {
        $file = fopen(Storage::disk('local')->path('auction_center_status.log'), 'a+');
        fwrite($file,$string."\n");
        fclose($file);
    }
}
