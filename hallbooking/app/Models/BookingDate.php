<?php
// app/Models/BookingDate.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDate extends Model
{
    use HasFactory;

    protected $table = 'booking_dates';

    protected $fillable = [
        'booking_id',
        'booking_date',
    ];

    // Relationship to Booking model
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // Relationship to BookingTimeSlot model
   

    public function timeSlots()
    {
        return $this->hasMany(BookingTimeSlot::class, 'date_id');
    }
}
