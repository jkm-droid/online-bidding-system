<?php

namespace App\Constants;

class AppConstants
{
    public static $pagination = 10;
    public static $product_expiration = 24;
    public static $bid_expiration = 20;
    public static $buyerStatus = array(
        'pending' => 'PENDING',
        'approved' => 'APPROVED',
        'rejected' => 'REJECTED',
    );
}
