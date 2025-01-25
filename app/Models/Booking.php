<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'childminder_id',
        'start_time',
        'end_time',
        'notes',
        'status',
    ];

    public function clientprofile()
    {
        return $this->belongsTo(ClientProfile::class);
    }

    public function childminderprofile()
    {
        return $this->belongsTo(ChildminderProfile::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'booking_language');
    }
}