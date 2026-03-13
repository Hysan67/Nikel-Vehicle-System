<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl leading-tight" style="color: #2D4059;">
            {{ __('Buat Pesanan Kendaraan Baru') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-md sm:rounded-lg" style="background-color: #ffffff; border-top: 4px solid #F07B3F;">
                <div class="p-6">
                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="vehicle_id" :value="__('Pilih Kendaraan')" />
                                <select id="vehicle_id" name="vehicle_id" class="mt-1 block w-full rounded-md shadow-sm" style="border: 1.5px solid #F07B3F;" required>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->model }} ({{ $vehicle->plate_number }}) - {{ $vehicle->location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="driver_id" :value="__('Pilih Driver')" />
                                <select id="driver_id" name="driver_id" class="mt-1 block w-full rounded-md shadow-sm" style="border: 1.5px solid #F07B3F;" required>
                                    @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="start_time" :value="__('Waktu Mulai')" />
                                <x-text-input id="start_time" name="start_time" type="datetime-local" class="mt-1 block w-full" required />
                            </div>
                            <div>
                                <x-input-label for="end_time" :value="__('Waktu Berakhir')" />
                                <x-text-input id="end_time" name="end_time" type="datetime-local" class="mt-1 block w-full" required />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="reason" :value="__('Keperluan / Alasan Pemakaian')" />
                                <textarea id="reason" name="reason" class="mt-1 block w-full rounded-md shadow-sm" style="border: 1.5px solid #F07B3F;" rows="3" required></textarea>
                            </div>
                            <div class="p-4 rounded-lg md:col-span-2" style="background-color: #EEEEEE; border: 1px solid #F07B3F;">
                                <h4 class="font-bold mb-3 text-sm uppercase tracking-wider" style="color: #2D4059;">Penetapan Penyetuju (Multilevel)</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <x-input-label for="supervisor_id" :value="__('Penyetuju Level 1 (Supervisor)')" />
                                        <select id="supervisor_id" name="supervisor_id" class="mt-1 block w-full rounded-md shadow-sm" style="border: 1.5px solid #F07B3F;" required>
                                            @foreach($supervisors as $supervisor)
                                            <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <x-input-label for="manager_id" :value="__('Penyetuju Level 2 (Manager)')" />
                                        <select id="manager_id" name="manager_id" class="mt-1 block w-full rounded-md shadow-sm" style="border: 1.5px solid #F07B3F;" required>
                                            @foreach($managers as $manager)
                                            <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>Terbitkan Pesanan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new TomSelect("#vehicle_id", {
                create: false,
                placeholder: 'Cari Kendaraan...',
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
            new TomSelect("#driver_id", {
                create: false,
                placeholder: 'Cari Nama Driver...',
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
            new TomSelect("#supervisor_id", { create: false });
            new TomSelect("#manager_id", { create: false });
        });
    </script>
</x-app-layout>
