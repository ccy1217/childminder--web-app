<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildminderProfile extends Model
{
    use HasFactory;
    // Make sure to add user_id to the fillable array
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'profile_picture',
        'about_me',
        'city',
        'town',
        'postcode',
        'hourly_rate',
        'age_groups',
        'geographical_area',
        'experience_years',
        'my_document',
        'is_verified',
    ];

    // You can also use $casts if needed to cast the 'age_groups' and 'my_document' attributes
    protected $casts = [
        'age_groups' => 'array',
        'my_document' => 'array',
    ];

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

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }
}