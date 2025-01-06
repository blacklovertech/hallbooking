<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BookingTimeSlot extends Model
{

    use HasFactory;

    protected $table = 'booking_time_slots';

    protected $fillable = [
        'date_id',
        'start_time',
        'end_time',
    ];

    // Relationship to BookingDate model
    public function bookingDate()
    {
        return $this->belongsTo(BookingDate::class, 'date_id');
    }
}
