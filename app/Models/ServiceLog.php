<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    protected $fillable = ['vehicle_id', 'service_date', 'description', 'cost', 'next_service_date'];

    public function vehicle() { return $this->belongsTo(Vehicle::class); }
}
