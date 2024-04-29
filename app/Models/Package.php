<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';

    protected $fillable = [
        'name',
        'original_price',
        'discount_percentage',
        'background_image',
        'product_code',
    ];

    // Accessor method to get the discounted price
    public function getDiscountedPriceAttribute(): float
    {
        // Calculate the discounted price based on original price and discount percentage
        return $this->original_price * (1 - ($this->discount_percentage / 100));
    }

    // You can define any relationships or additional methods here
}
