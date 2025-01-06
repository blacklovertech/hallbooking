<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'institution',
        'department',
        'phone',
        'usertype',  // Make sure to include this field
        'password',
    ];

    protected $hidden = [
        'password',
        'verifyToken',
    ];

    public function tokens()
    {
        return $this->hasMany(UserToken::class, 'user_id');
    }


    public function bookings()
    {
        return $this->hasMany(Booking::class, 'userId'); // Ensure 'userId' is the correct foreign key
    }
    // Check if the user is an admin
    public function isAdmin()
    {
        return $this->usertype === 'admin';
    }

    // Check if the user is a head of department (HOD)
    public function isHod()
    {
        return $this->usertype === 'hod';
    }

    // Check if the user is a registrar
    public function isRegistrar()
    {
        return $this->usertype === 'registrar';
    }

      // Check if the user is a registrar
      public function isFaculty()
      {
          return $this->usertype === 'faculty';
      }

}
