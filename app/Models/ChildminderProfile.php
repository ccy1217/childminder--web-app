<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildminderProfile extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
    return $this->hasMany(Booking::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}