<?php

namespace App\Exports;

use App\Models\Booking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookingsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Booking::with(['user', 'vehicle', 'driver'])->get();
    }

    public function map($booking): array
    {
        return [
            $booking->id,
            $booking->user->name,
            $booking->vehicle->model . ' (' . $booking->vehicle->plate_number . ')',
            $booking->driver->name ?? 'N/A',
            $booking->start_time,
            $booking->end_time,
            match($booking->status) {
                'pending' => 'Menunggu',
                'approved' => 'Disetujui',
                'on_progress' => 'Sedang Berjalan',
                'completed' => 'Selesai',
                'rejected' => 'Ditolak',
                default => $booking->status
            },
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Requester',
            'Vehicle',
            'Driver',
            'Start Time',
            'End Time',
            'Status',
        ];
    }
}
