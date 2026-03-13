<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl leading-tight" style="color: #2D4059;">
                {{ __('Daftar Pemesanan Kendaraan') }}
            </h2>
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('bookings.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-bold text-xs uppercase tracking-widest transition ease-in-out duration-150" style="background-color: #F07B3F; color: #EEEEEE;" onmouseover="this.style.backgroundColor='#2D4059';" onmouseout="this.style.backgroundColor='#F07B3F';">
                + Buat Pesanan
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-md sm:rounded-lg" style="background-color: #ffffff;">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y" style="border-color: #F07B3F;">
                            <thead>
                                <tr style="background-color: #2D4059;">
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Pemesan</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Kendaraan</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Mulai</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y" style="border-color: #EEEEEE;">
                                @foreach($bookings as $booking)
                                <tr onmouseover="this.style.backgroundColor='#EEEEEE';" onmouseout="this.style.backgroundColor='';">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: #2D4059;">{{ $booking->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: #2D4059;">{{ $booking->vehicle->model }} ({{ $booking->vehicle->plate_number }})</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: #2D4059;">{{ $booking->start_time }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs font-bold rounded-full 
                                            {{ $booking->status == 'approved' ? 'bg-green-100 text-green-800' : 
                                               ($booking->status == 'rejected' ? 'bg-red-100 text-red-800' : '') }}"
                                            @if($booking->status == 'pending') style="background-color: #FFD460; color: #2D4059;" @endif>
                                            {{ strtoupper($booking->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                        <a href="{{ route('bookings.show', $booking->id) }}" class="font-semibold hover:underline" style="color: #F07B3F;">Detail</a>
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
