<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = \App\Models\Driver::paginate(10);
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
        ]);

        \App\Models\Driver::create($validated);
        return redirect()->route('admin.drivers.index')->with('success', 'Driver berhasil ditambahkan.');
    }

    public function edit(\App\Models\Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, \App\Models\Driver $driver)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'status' => 'required|in:available,in_use',
        ]);

        $driver->update($validated);

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'UPDATE_DRIVER',
            'description' => "Updated driver {$driver->name}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver berhasil diperbarui.');
    }
}
