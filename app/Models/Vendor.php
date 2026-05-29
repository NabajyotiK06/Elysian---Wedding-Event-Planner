<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'name',
        'type', // e.g., 'Caterer', 'Photographer', 'Florist', 'Venue'
        'location',
        'price',
        'rating',
        'description',
        'image_url'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_vendor')
                    ->withPivot('booking_date', 'status')
                    ->withTimestamps();
    }
}
