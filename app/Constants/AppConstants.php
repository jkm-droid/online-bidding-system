<?php

namespace App\Constants;

class AppConstants
{
    public static $pagination = 10;
    public static $product_expiration = 74;
    public static $bid_expiration = 70;
    public static $buyerStatus = array(
        'pending' => 'PENDING',
        'approved' => 'APPROVED',
        'rejected' => 'REJECTED',
    );
}
