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
        'start_date',
        'total_available_tickets', 
    ];

    protected $dates = [
        'start_date', // Define start_date as a date attribute
      // Define end_date as a date attribute
    ];

  
    public function getDiscountedPriceAttribute(): float
    {
       
        return $this->original_price * (1 - ($this->discount_percentage / 100));
    }

   
}
