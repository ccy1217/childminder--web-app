<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    /**
     * Relationship: A service can be offered by many childminders.
     */
    public function childminderProfiles()
    {
        return $this->belongsToMany(ChildminderProfile::class);
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class);
    }

}