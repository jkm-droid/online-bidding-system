<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id' ,
        'bid_price',
        'bid_comment',
        'expires_at'
    ];

    /**
     * Get the buyer that owns the bid.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that owns the bid.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
