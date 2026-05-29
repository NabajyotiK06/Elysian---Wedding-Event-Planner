<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'date',
        'budget',
        'description',
        'location'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'event_vendor')
                    ->withPivot('booking_date', 'status')
                    ->withTimestamps();
    }

    public function getTotalVendorCostAttribute()
    {
        return $this->vendors->sum('price');
    }

    public function getRemainingBudgetAttribute()
    {
        return $this->budget - $this->total_vendor_cost;
    }
}
