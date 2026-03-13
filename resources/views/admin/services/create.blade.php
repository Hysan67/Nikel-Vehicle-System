<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #2D4059;">
            {{ __('Tambah Riwayat Service') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-md sm:rounded-lg" style="background-color: #ffffff; border-top: 4px solid #F07B3F;">
                <div class="p-6">
                    <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-6">
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
                                <x-input-label for="service_date" :value="__('Tanggal Service / Perbaikan')" />
                                <x-text-input id="service_date" name="service_date" type="date" class="mt-1 block w-full" style="border: 1.5px solid #F07B3F;" required />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="description" :value="__('Deskripsi Perbaikan / Suku Cadang')" />
                                <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md shadow-sm" style="border: 1.5px solid #F07B3F;" required></textarea>
                            </div>
                            <div>
                                <x-input-label for="cost" :value="__('Total Biaya (Rp)')" />
                                <x-text-input id="cost" name="cost" type="number" class="mt-1 block w-full" style="border: 1.5px solid #F07B3F;" placeholder="Contoh: 1500000" required />
                            </div>
                            <div>
                                <x-input-label for="next_service_date" :value="__('Jadwal Service Berikutnya (Opsional)')" />
                                <x-text-input id="next_service_date" name="next_service_date" type="date" class="mt-1 block w-full" style="border: 1.5px solid #F07B3F;" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.services.index') }}" class="text-sm underline px-4" style="color: #2D4059;">Batal</a>
                            <x-primary-button style="background-color: #F07B3F; hover:background-color: #d66a33;">
                                {{ __('Simpan Riwayat Mengingatkan') }}
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
        });
    </script>
</x-app-layout>
