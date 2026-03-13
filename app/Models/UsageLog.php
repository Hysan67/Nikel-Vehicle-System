<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsageLog extends Model
{
    protected $fillable = ['vehicle_id', 'booking_id', 'fuel_consumed', 'distance_km', 'date'];

    public function vehicle() { return $this->belongsTo(Vehicle::class); }
    public function booking() { return $this->belongsTo(Booking::class); }
}
