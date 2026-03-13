<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #2D4059;">
            {{ __('Tambah Catatan Konsumsi BBM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-md sm:rounded-lg" style="background-color: #ffffff; border-top: 4px solid #F07B3F;">
                <div class="p-6">
                    <form action="{{ route('admin.usages.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="vehicle_id" :value="__('Pilih Kendaraan')" />
                                <select id="vehicle_id" name="vehicle_id" class="mt-1 block w-full rounded-md shadow-sm" style="border: 1.5px solid #F07B3F;" required>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->model }} ({{ $vehicle->plate_number }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="booking_id" :value="__('Terkait Pemesanan (Opsional)')" />
                                <select id="booking_id" name="booking_id" class="mt-1 block w-full rounded-md shadow-sm" style="border: 1.5px solid #F07B3F;">
                                    <option value="">Tidak Terkait Pemesanan</option>
                                    @foreach($bookings as $booking)
                                    <option value="{{ $booking->id }}">#{{ $booking->id }} - {{ $booking->user->name }} ({{ \Carbon\Carbon::parse($booking->start_time)->format('Y-m-d') }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="fuel_consumed" :value="__('Konsumsi BBM (Liter)')" />
                                <x-text-input id="fuel_consumed" name="fuel_consumed" type="number" step="0.01" class="mt-1 block w-full" style="border: 1.5px solid #F07B3F;" placeholder="Contoh: 15.5" required />
                            </div>
                            <div>
                                <x-input-label for="distance_km" :value="__('Jarak Tempuh (KM)')" />
                                <x-text-input id="distance_km" name="distance_km" type="number" class="mt-1 block w-full" style="border: 1.5px solid #F07B3F;" placeholder="Contoh: 150" required />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="date" :value="__('Tanggal Pencatatan')" />
                                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" style="border: 1.5px solid #F07B3F;" required />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.usages.index') }}" class="text-sm underline px-4" style="color: #2D4059;">Batal</a>
                            <x-primary-button style="background-color: #F07B3F; hover:background-color: #d66a33;">
                                {{ __('Simpan Pencatatan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new TomSelect("#vehicle_id", { create: false, placeholder: 'Cari Kendaraan...' });
            new TomSelect("#booking_id", { create: false, placeholder: 'Cari Kode Booking...' });
        });
    </script>
</x-app-layout>
