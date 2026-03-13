<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight" style="color: #2D4059;">
                {{ __('Daftar Konsumsi BBM (Usage Logs)') }}
            </h2>
            <a href="{{ route('admin.usages.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150" style="background-color: #2D4059; hover:background-color: #3b5375;">
                Tambah Pencatatan BBM
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
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Kendaraan</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Pemesan (Booking)</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">BBM (Liter)</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Jarak (KM)</th>
                                <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="border-color: #EEEEEE;">
                            @foreach($usageLogs as $log)
                            <tr onmouseover="this.style.backgroundColor='#EEEEEE';" onmouseout="this.style.backgroundColor='';">
                                <td class="px-6 py-4 text-sm font-medium" style="color: #2D4059;">{{ \Carbon\Carbon::parse($log->date)->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm font-bold" style="color: #2D4059;">{{ $log->vehicle->model }} <span class="text-xs font-normal bg-gray-100 rounded px-1 absolute mt-1 ml-1">{{ $log->vehicle->plate_number }}</span></td>
                                <td class="px-6 py-4 text-sm" style="color: #2D4059;">{{ $log->booking ? $log->booking->user->name : 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm font-bold" style="color: #ea5455;">{{ $log->fuel_consumed }} L</td>
                                <td class="px-6 py-4 text-sm" style="color: #2D4059;">{{ $log->distance_km }} KM</td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <a href="{{ route('admin.usages.edit', $log->id) }}" class="font-semibold hover:underline" style="color: #F07B3F;">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $usageLogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
