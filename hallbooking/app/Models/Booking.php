<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = ['eventName', 'hallId', 'reason', 'pdf', 'userId','organisingClub','capacityRequired','amenities'];

    // Relationship to User model
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }



    // Relationship to BookingDate model
    public function bookingDates()
    {
        return $this->hasMany(BookingDate::class, 'booking_id');
    }

    public function dates()
    {
        return $this->hasMany(BookingDate::class);
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class);
    }
    public function hall()
    {
        return $this->belongsTo(Hall::class, 'hallId'); // specify custom foreign key
    }
    public function timeSlots()
    {
        return $this->hasMany(BookingTimeSlot::class);
    }
  
    
}
