<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['model', 'plate_number', 'type', 'ownership', 'status', 'location_id', 'fuel_ratio'];

    public function location() { return $this->belongsTo(Location::class); }
    public function usageLogs() { return $this->hasMany(UsageLog::class); }
    public function serviceLogs() { return $this->hasMany(ServiceLog::class); }
}
