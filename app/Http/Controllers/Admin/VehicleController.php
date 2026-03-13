<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = \App\Models\Vehicle::with('location')->paginate(10);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $locations = \App\Models\Location::all();
        return view('admin.vehicles.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'model' => 'required',
            'plate_number' => 'required|unique:vehicles',
            'type' => 'required|in:personnel,cargo',
            'ownership' => 'required|in:company,rented',
            'location_id' => 'required|exists:locations,id',
            'fuel_ratio' => 'required|numeric|min:0.1',
        ]);

        \App\Models\Vehicle::create($validated);
        
        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'CREATE_VEHICLE',
            'description' => "Created vehicle {$validated['plate_number']}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.vehicles.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(\App\Models\Vehicle $vehicle)
    {
        $locations = \App\Models\Location::all();
        return view('admin.vehicles.edit', compact('vehicle', 'locations'));
    }

    public function update(Request $request, \App\Models\Vehicle $vehicle)
    {
        $validated = $request->validate([
            'model' => 'required',
            'plate_number' => 'required|unique:vehicles,plate_number,' . $vehicle->id,
            'type' => 'required|in:personnel,cargo',
            'ownership' => 'required|in:company,rented',
            'status' => 'required|in:available,in_use,maintenance',
            'location_id' => 'required|exists:locations,id',
            'fuel_ratio' => 'required|numeric|min:0.1',
        ]);

        $vehicle->update($validated);

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'UPDATE_VEHICLE',
            'description' => "Updated vehicle {$vehicle->plate_number}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.vehicles.index')->with('success', 'Kendaraan berhasil diperbarui.');
    }
}
