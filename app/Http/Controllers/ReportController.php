<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $bookings = \App\Models\Booking::with(['user', 'vehicle', 'driver'])->latest()->paginate(10);
        return view('reports.index', compact('bookings'));
    }

    public function export()
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\BookingsExport, 'bookings_report.xlsx');
    }
}
