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
}
