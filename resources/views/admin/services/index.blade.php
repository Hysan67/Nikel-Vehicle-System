<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight" style="color: #2D4059;">
                {{ __('Daftar Riwayat Service') }}
            </h2>
            <a href="{{ route('admin.services.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150" style="background-color: #2D4059; hover:background-color: #3b5375;">
                Tambah Riwayat Service
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y" style="border-color: #EEEEEE;">
                        <thead>
                            <tr style="background-color: #2D4059;">
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Tanggal Service</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Kendaraan</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Deskripsi</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Biaya</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Jadwal Berikutnya</th>
                                <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="border-color: #EEEEEE;">
                            @foreach($serviceLogs as $log)
                            <tr onmouseover="this.style.backgroundColor='#EEEEEE';" onmouseout="this.style.backgroundColor='';">
                                <td class="px-6 py-4 text-sm font-medium" style="color: #2D4059;">{{ \Carbon\Carbon::parse($log->service_date)->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm font-bold" style="color: #2D4059;">{{ $log->vehicle->model }} <span class="text-xs font-normal bg-gray-100 rounded px-1 absolute mt-1 ml-1">{{ $log->vehicle->plate_number }}</span></td>
                                <td class="px-6 py-4 text-sm max-w-xs truncate" style="color: #2D4059;">{{ $log->description }}</td>
                                <td class="px-6 py-4 text-sm font-bold" style="color: #4CAF50;">Rp {{ number_format($log->cost, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm" style="color: #2D4059;">
                                    @if($log->next_service_date)
                                        {{ \Carbon\Carbon::parse($log->next_service_date)->format('d M Y') }}
                                        @if(\Carbon\Carbon::parse($log->next_service_date)->isPast())
                                            <span class="text-[10px] bg-[#EA5455] text-white px-1 rounded ml-1 uppercase font-bold">Terlewat</span>
                                        @elseif(\Carbon\Carbon::parse($log->next_service_date)->diffInDays(now()) <= 7)
                                            <span class="text-[10px] bg-[#FFD460] text-gray-800 px-1 rounded ml-1 uppercase font-bold">Segera</span>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <a href="{{ route('admin.services.edit', $log->id) }}" class="font-semibold hover:underline" style="color: #F07B3F;">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $serviceLogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
