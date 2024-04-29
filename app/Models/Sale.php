<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'discounted_price',
        'customer_name',
        'customer_email',
        'branch_name',
        'sale_date',
    ];

    protected $dates = ['sale_date'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
