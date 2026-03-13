<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Laporan Pemakaian Kendaraan') }}
            </h2>
            <a href="{{ route('reports.export') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 transition ease-in-out duration-150">
                Export ke Excel (.xlsx)
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemesan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kendaraan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Driver</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mulai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Selesai</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-sm">
                                @foreach($bookings as $booking)
                                <tr>
                                    <td class="px-6 py-4">{{ $booking->id }}</td>
                                    <td class="px-6 py-4">{{ $booking->user->name }}</td>
                                    <td class="px-6 py-4">{{ $booking->vehicle->model }}</td>
                                    <td class="px-6 py-4">{{ $booking->driver->name ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $booking->start_time }}</td>
                                    <td class="px-6 py-4">{{ $booking->end_time }}</td>
                                    <td class="px-6 py-4">
                                        @php
                                            $statusColors = [
                                                'pending' => 'bg-[#FFD460] text-[#2D4059]',
                                                'approved' => 'bg-[#4CAF50] text-[#EEEEEE]',
                                                'on_progress' => 'bg-[#F07B3F] text-[#EEEEEE]',
                                                'completed' => 'bg-[#2D4059] text-[#EEEEEE]',
                                                'rejected' => 'bg-[#EA5455] text-[#EEEEEE]',
                                            ];
                                            $statusLabels = [
                                                'pending' => 'Menunggu',
                                                'approved' => 'Disetujui',
                                                'on_progress' => 'Sedang Berjalan',
                                                'completed' => 'Selesai',
                                                'rejected' => 'Ditolak',
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 rounded text-xs font-bold {{ $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-700' }}">
                                            {{ strtoupper($statusLabels[$booking->status] ?? $booking->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
