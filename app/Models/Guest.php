<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'rsvp_status', // 'pending', 'attending', 'declined'
        'plus_ones'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
