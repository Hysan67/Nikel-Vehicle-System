<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pemesanan #') }}{{ $booking->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Info Section -->
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white shadow sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4 border-b pb-2">Informasi Kendaraan & Driver</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="text-gray-500 uppercase font-bold text-xs">Model Kendaraan</div>
                            <div class="dark:text-gray-600">{{ $booking->vehicle->model }}</div>
                            
                            <div class="text-gray-500 uppercase font-bold text-xs">Nomor Plat</div>
                            <div class="dark:text-gray-600 font-mono bg-gray-100 px-1 rounded w-fit">{{ $booking->vehicle->plate_number }}</div>

                            <div class="text-gray-500 uppercase font-bold text-xs">Nama Driver</div>
                            <div class="dark:text-gray-600">{{ $booking->driver->name }}</div>

                            <div class="text-gray-500 uppercase font-bold text-xs">Periode Pakai</div>
                            <div class="dark:text-gray-600">{{ $booking->start_time }} s/d {{ $booking->end_time }}</div>
                        </div>

                        <h3 class="text-lg font-bold mt-8 mb-4 border-b pb-2">Keperluan</h3>
                        <p class="text-sm">{{ $booking->reason }}</p>
                    </div>
                </div>

                <!-- Approval Section -->
                <div class="space-y-6">
                    <div class="bg-white shadow sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4 border-b pb-2">Status Persetujuan</h3>
                        <div class="space-y-4">
                            @foreach($booking->approvals->sortBy('level') as $approval)
                            <div class="p-4 rounded-lg border {{ $approval->status == 'approved' ? 'border-green-200 bg-green-50' : ($approval->status == 'rejected' ? 'border-red-200 bg-red-50' : 'border-yellow-200 bg-yellow-50') }}">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-xs font-bold uppercase text-gray-500">Level {{ $approval->level }}</span>
                                    <span class="text-xs font-bold {{ $approval->status == 'approved' ? 'text-green-700' : ($approval->status == 'rejected' ? 'text-red-700' : 'text-yellow-700') }}">
                                        {{ strtoupper($approval->status) }}
                                    </span>
                                </div>
                                <div class="text-sm font-semibold">{{ $approval->user->role == 'supervisor' ? 'Supervisor' : 'Manager' }}: {{ $approval->user->name }}</div>
                                
                                @if($approval->status == 'pending' && $approval->user_id == auth()->id())
                                <div class="mt-4 flex space-x-2">
                                    <form action="{{ route('approvals.approve', $approval->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button class="w-full bg-green-600 hover:bg-green-700 text-white text-xs py-2 rounded font-bold">Setujui</button>
                                    </form>
                                    <form action="{{ route('approvals.reject', $approval->id) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button class="w-full bg-red-600 hover:bg-red-700 text-white text-xs py-2 rounded font-bold">Tolak</button>
                                    </form>
                                </div>
                                @endif
                                
                                @if($approval->comment)
                                <div class="mt-2 pt-2 border-t border-gray-200 text-xs italic text-gray-600">
                                    "{{ $approval->comment }}"
                                </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @if($booking->status == 'approved' && auth()->user()->role == 'admin')
                <div class="md:col-span-3 mt-4 flex justify-end">
                    <form action="{{ route('bookings.inProgress', $booking->id) }}" method="POST">
                        @csrf
                        <button class="bg-[#F07B3F] hover:bg-[#d66a33] text-white font-bold py-2 px-6 rounded shadow">
                            Mulai Perjalanan
                        </button>
                    </form>
                </div>
                @endif

                @if($booking->status == 'on_progress' && auth()->user()->role == 'admin')
                <div class="md:col-span-3 mt-4">
                    <div class="bg-white shadow sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4 border-b pb-2">Selesaikan Perjalanan</h3>
                        <form action="{{ route('bookings.complete', $booking->id) }}" method="POST" class="flex flex-col md:flex-row md:items-end gap-4 justify-end">
                            @csrf
                            <div class="flex-1 max-w-xs">
                                <label for="distance_km" class="block text-sm font-medium text-gray-700 mb-1">Jarak Tempuh (KM)</label>
                                <input type="number" id="distance_km" name="distance_km" required class="mt-1 block w-full rounded-md shadow-sm" style="border: 1.5px solid #F07B3F;" placeholder="Contoh: 150">
                                <p class="text-[10px] text-gray-500 mt-1">Sistem otomatis menghitung liter BBM berdasarkan tipe kendaraan.</p>
                            </div>
                            <button class="bg-[#4CAF50] hover:bg-[#3d8c40] text-white font-bold py-2 px-6 rounded shadow h-10 border border-transparent">
                                Selesaikan Perjalanan
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
