<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    // Define which attributes are mass assignable
    protected $fillable = [
        'name',
        'capacity',
        'location',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'hallId'); // specify custom foreign key
    }
    
}
