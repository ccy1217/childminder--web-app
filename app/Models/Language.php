<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function childminderprofiles()
    {
        return $this->belongsToMany(ChildminderProfile::class);
    }

    public function clientprofiles()
    {
        return $this->belongsToMany(ClientProfile::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_language');
    }
}
