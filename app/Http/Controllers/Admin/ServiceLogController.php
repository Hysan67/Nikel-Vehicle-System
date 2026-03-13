<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceLog;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ServiceLogController extends Controller
{
    public function index()
    {
        $serviceLogs = ServiceLog::with('vehicle')->latest()->paginate(10);
        return view('admin.services.index', compact('serviceLogs'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        return view('admin.services.create', compact('vehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_date' => 'required|date',
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'next_service_date' => 'nullable|date|after:service_date',
        ]);

        ServiceLog::create($validated);
        return redirect()->route('admin.services.index')->with('success', 'Catatan service berhasil ditambahkan.');
    }

    public function edit(ServiceLog $service)
    {
        $vehicles = Vehicle::all();
        return view('admin.services.edit', compact('service', 'vehicles'));
    }

    public function update(Request $request, ServiceLog $service)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'service_date' => 'required|date',
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'next_service_date' => 'nullable|date|after:service_date',
        ]);

        $service->update($validated);
        return redirect()->route('admin.services.index')->with('success', 'Catatan service berhasil diperbarui.');
    }
}
