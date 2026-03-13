<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kendaraan') }} : {{ $vehicle->plate_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="model" :value="__('Model / Merk Kendaraan')" />
                                <x-text-input id="model" name="model" type="text" class="mt-1 block w-full" :value="old('model', $vehicle->model)" required />
                            </div>
                            <div>
                                <x-input-label for="plate_number" :value="__('Nomor Plat')" />
                                <x-text-input id="plate_number" name="plate_number" type="text" class="mt-1 block w-full" :value="old('plate_number', $vehicle->plate_number)" required />
                            </div>
                            <div>
                                <x-input-label for="type" :value="__('Jenis Kendaraan')" />
                                <select id="type" name="type" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="personnel" {{ $vehicle->type == 'personnel' ? 'selected' : '' }}>Angkutan Orang</option>
                                    <option value="cargo" {{ $vehicle->type == 'cargo' ? 'selected' : '' }}>Angkutan Barang</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="ownership" :value="__('Status Kepemilikan')" />
                                <select id="ownership" name="ownership" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="company" {{ $vehicle->ownership == 'company' ? 'selected' : '' }}>Milik Perusahaan</option>
                                    <option value="rented" {{ $vehicle->ownership == 'rented' ? 'selected' : '' }}>Sewa</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="fuel_ratio" :value="__('Rasio BBM (KM/Liter)')" />
                                <x-text-input id="fuel_ratio" name="fuel_ratio" type="number" step="0.01" :value="old('fuel_ratio', $vehicle->fuel_ratio)" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required />
                                <p class="text-[10px] text-gray-500 mt-1">Contoh: 10.0 (artinya 1 Liter = 10 KM)</p>
                            </div>
                            <div>
                                <x-input-label for="status" :value="__('Status Kendaraan')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="available" {{ $vehicle->status == 'available' ? 'selected' : '' }}>Tersedia</option>
                                    <option value="in_use" {{ $vehicle->status == 'in_use' ? 'selected' : '' }}>Sedang Dipakai</option>
                                    <option value="maintenance" {{ $vehicle->status == 'maintenance' ? 'selected' : '' }}>Perawatan</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="location_id" :value="__('Lokasi Penempatan (Pool)')" />
                                <select id="location_id" name="location_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ $vehicle->location_id == $location->id ? 'selected' : '' }}>{{ $location->name }} ({{ $location->region }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.vehicles.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline decoration-indigo-500 px-4">Batal</a>
                            <x-primary-button class="ml-4 bg-[#F07B3F] hover:bg-[#d66a33]">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new TomSelect("#location_id", { create: false, placeholder: 'Cari Lokasi...' });
            new TomSelect("#type", { create: false });
            new TomSelect("#ownership", { create: false });
            new TomSelect("#status", { create: false });
        });
    </script>
</x-app-layout>
