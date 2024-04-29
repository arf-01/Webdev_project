<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'hometown', // Renamed from 'branch'
        'branch',   // New column
        'session',  // New column
    ];


    protected static function boot()
    {
        parent::boot();

        // Listen for the 'creating' event
        static::creating(function ($user) {
            // Check if the branch attribute is empty
            if (empty($user->branch)) {
                // Set the default branch value
                $user->branch = 'default_branch';
            }
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    
}
