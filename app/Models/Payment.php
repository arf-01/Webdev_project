<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'month',
        'year',
        'paid',
        'amount', // Include the 'amount' attribute in the fillable array
    ];

    /**
     * Get the user that owns the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

