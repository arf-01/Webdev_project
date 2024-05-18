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
        'description',
      
    ];


    public function getDiscountedPriceAttribute(): float
    {
        return $this->original_price * (1 - ($this->discount_percentage / 100));
    }
}
