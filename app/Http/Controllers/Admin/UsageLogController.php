<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UsageLog;
use App\Models\Vehicle;
use App\Models\Booking;
use Illuminate\Http\Request;

class UsageLogController extends Controller
{
    public function index()
    {
        $usageLogs = UsageLog::with(['vehicle', 'booking.user'])->latest()->paginate(10);
        return view('admin.usages.index', compact('usageLogs'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $bookings = Booking::where('status', 'completed')->with('user')->get();
        return view('admin.usages.create', compact('vehicles', 'bookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'booking_id' => 'nullable|exists:bookings,id',
            'fuel_consumed' => 'required|numeric|min:0',
            'distance_km' => 'required|integer|min:0',
            'date' => 'required|date',
        ]);

        UsageLog::create($validated);
        return redirect()->route('admin.usages.index')->with('success', 'Catatan konsumsi BBM berhasil ditambahkan.');
    }

    public function edit(UsageLog $usage)
    {
        $vehicles = Vehicle::all();
        $bookings = Booking::where('status', 'completed')->orWhere('id', $usage->booking_id)->with('user')->get();
        return view('admin.usages.edit', compact('usage', 'vehicles', 'bookings'));
    }

    public function update(Request $request, UsageLog $usage)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'booking_id' => 'nullable|exists:bookings,id',
            'fuel_consumed' => 'required|numeric|min:0',
            'distance_km' => 'required|integer|min:0',
            'date' => 'required|date',
        ]);

        $usage->update($validated);
        return redirect()->route('admin.usages.index')->with('success', 'Catatan konsumsi BBM berhasil diperbarui.');
    }
}
