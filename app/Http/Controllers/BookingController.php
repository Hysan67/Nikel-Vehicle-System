<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = \App\Models\Booking::with(['user', 'vehicle', 'driver'])->latest();

        if ($user->role !== 'admin') {
            $query->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhereHas('approvals', function($aq) use ($user) {
                      $aq->where('user_id', $user->id);
                  });
            });
        }

        $bookings = $query->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $vehicles = \App\Models\Vehicle::where('status', 'available')->get();
        $drivers = \App\Models\Driver::where('status', 'available')->get();
        $supervisors = \App\Models\User::where('role', 'supervisor')->get();
        $managers = \App\Models\User::where('role', 'manager')->get();

        return view('bookings.create', compact('vehicles', 'drivers', 'supervisors', 'managers'));
    }

    public function show($id)
    {
        $booking = \App\Models\Booking::with(['user', 'vehicle', 'driver', 'approvals.user'])->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:drivers,id',
            'supervisor_id' => 'required|exists:users,id', // L1
            'manager_id' => 'required|exists:users,id',    // L2
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'reason' => 'required',
        ]);

        $booking = \App\Models\Booking::create([
            'user_id' => auth()->id(),
            'vehicle_id' => $validated['vehicle_id'],
            'driver_id' => $validated['driver_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'reason' => $validated['reason'],
            'status' => 'pending',
        ]);

        // Level 1 Approval
        \App\Models\Approval::create([
            'booking_id' => $booking->id,
            'user_id' => $validated['supervisor_id'],
            'level' => 1,
            'status' => 'pending',
        ]);

        // Level 2 Approval
        \App\Models\Approval::create([
            'booking_id' => $booking->id,
            'user_id' => $validated['manager_id'],
            'level' => 2,
            'status' => 'pending',
        ]);

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'CREATE_BOOKING',
            'description' => "Created booking #{$booking->id}",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('dashboard');
    }

    public function markAsInProgress($id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        
        if ($booking->status !== 'approved') {
            return back()->with('error', 'Pemesanan belum disetujui.');
        }

        $booking->update(['status' => 'on_progress']);
        
        if ($booking->vehicle) {
            $booking->vehicle->update(['status' => 'in_use']);
        }
        if ($booking->driver) {
            $booking->driver->update(['status' => 'in_use']);
        }

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'START_BOOKING',
            'description' => "Started booking #{$booking->id}",
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', 'Perjalanan telah dimulai. Status kendaraan dan driver telah diubah ke Sedang Dipakai.');
    }

    public function markAsCompleted(Request $request, $id)
    {
        $validated = $request->validate([
            'distance_km' => 'required|integer|min:1',
        ]);

        $booking = \App\Models\Booking::findOrFail($id);
        
        if ($booking->status !== 'on_progress') {
            return back()->with('error', 'Perjalanan belum dimulai.');
        }

        $booking->update([
            'status' => 'completed',
            'distance_km' => $validated['distance_km']
        ]);
        
        $fuelConsumed = 0;
        if ($booking->vehicle) {
            $booking->vehicle->update(['status' => 'available']);
            
            // Calculate fuel based on vehicle's fuel ratio
            $fuelConsumed = round($validated['distance_km'] / $booking->vehicle->fuel_ratio, 2);

            // Automatically create UsageLog
            \App\Models\UsageLog::create([
                'vehicle_id' => $booking->vehicle_id,
                'booking_id' => $booking->id,
                'fuel_consumed' => $fuelConsumed,
                'distance_km' => $validated['distance_km'],
                'date' => now(),
            ]);
        }
        
        if ($booking->driver) {
            $booking->driver->update(['status' => 'available']);
        }

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'COMPLETE_BOOKING',
            'description' => "Completed booking #{$booking->id} ({$validated['distance_km']} KM, {$fuelConsumed} L)",
            'ip_address' => request()->ip(),
        ]);

        return back()->with('success', "Perjalanan selesai. Tercatat {$validated['distance_km']} KM dan otomatis terhitung {$fuelConsumed} Liter BBM.");
    }
}
