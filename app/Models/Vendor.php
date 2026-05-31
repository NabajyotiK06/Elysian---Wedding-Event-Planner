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
        'image_url',
        'is_custom',
        'user_id',
    ];

    protected $casts = [
        'is_custom' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_vendor')
                    ->withPivot('booking_date', 'status')
                    ->withTimestamps();
    }
}
