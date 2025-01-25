<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'childminder_id', 'booking_id', 'comment', 'rating'];

    /**
     * Relationship: A comment belongs to a client.
     */
    public function clientprofile()
    {
        return $this->belongsTo(ClientProfile::class);
    }

    /**
     * Relationship: A comment belongs to a childminder.
     */
    public function childminderprofile()
    {
        return $this->belongsTo(ChildminderProfile::class);
    }
}