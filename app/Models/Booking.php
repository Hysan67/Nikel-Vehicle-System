<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'vehicle_id', 'driver_id', 'start_time', 'end_time', 'reason', 'status', 'distance_km'];

    public function user() { return $this->belongsTo(User::class); }
    public function vehicle() { return $this->belongsTo(Vehicle::class); }
    public function driver() { return $this->belongsTo(Driver::class); }
    public function approvals() { return $this->hasMany(Approval::class); }
}
