<?php

namespace App\Constants;

use Carbon\Carbon;

class AppConstants
{
    public static $pagination = 10;
    public static $product_expiration = 4;
    public static $bid_expiration = 4;
    public static $buyerStatus = array(
        'pending' => 'PENDING',
        'approved' => 'APPROVED',
        'rejected' => 'REJECTED',
    );

    public static function file_name($key){
        $file_name = 'check_'.$key.'_status_'.Carbon::now().'.log';
        return str_replace(array(' ',':','-'),'_',$file_name);
    }
}
