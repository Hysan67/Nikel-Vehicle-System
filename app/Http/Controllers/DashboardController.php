<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_vehicles' => \App\Models\Vehicle::count(),
            'active_bookings' => \App\Models\Booking::whereIn('status', ['pending', 'approved'])->count(),
            'total_drivers' => \App\Models\Driver::count(),
            'recent_activities' => \App\Models\ActivityLog::latest()->take(5)->get(),
        ];

        // Fetch monthly data for the current year
        $currentYear = date('Y');
        
        $monthlyBookings = \App\Models\Booking::whereYear('start_time', $currentYear)
            ->whereIn('status', ['on_progress', 'completed'])
            ->selectRaw('strftime("%m", start_time) as month, count(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month')->toArray();

        $monthlyFuel = \App\Models\UsageLog::whereYear('date', $currentYear)
            ->selectRaw('strftime("%m", date) as month, sum(fuel_consumed) as total')
            ->groupBy('month')
            ->pluck('total', 'month')->toArray();

        $monthlyService = \App\Models\ServiceLog::whereYear('service_date', $currentYear)
            ->selectRaw('strftime("%m", service_date) as month, sum(cost) as total')
            ->groupBy('month')
            ->pluck('total', 'month')->toArray();

        // Format data for Chart.js (12 months)
        $chartData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'],
            'bookings' => [],
            'fuel' => [],
            'service' => []
        ];

        for ($i = 1; $i <= 12; $i++) {
            $monthKey = str_pad($i, 2, '0', STR_PAD_LEFT);
            $chartData['bookings'][] = $monthlyBookings[$monthKey] ?? 0;
            $chartData['fuel'][] = $monthlyFuel[$monthKey] ?? 0;
            $chartData['service'][] = $monthlyService[$monthKey] ?? 0;
        }

        return view('dashboard', compact('stats', 'chartData'));
    }
}
