<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Ensure user_id is also mass assignable if necessary
        'first_name',
        'last_name',
        'children_name',
        'profile_picture',
        'city',
        'town',
        'postcode',
        'preferred_age_groups',
        'specific_requirements',
        
    ];

    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
    return $this->hasMany(Booking::class, 'client_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

}