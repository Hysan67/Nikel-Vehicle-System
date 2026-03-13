<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color: #2D4059;">
            {{ __('Edit Lokasi') }}: {{ $location->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-md sm:rounded-lg" style="background-color: #ffffff; border-top: 4px solid #F07B3F;">
                <div class="p-6">
                    <form action="{{ route('admin.locations.update', $location->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="name" :value="__('Nama Lokasi')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" style="border: 1.5px solid #F07B3F;" :value="old('name', $location->name)" required />
                            </div>
                            <div>
                                <x-input-label for="type" :value="__('Tipe Lokasi')" />
                                <select id="type" name="type" class="mt-1 block w-full rounded-md shadow-sm" style="border: 1.5px solid #F07B3F;" required>
                                    <option value="head_office" {{ $location->type == 'head_office' ? 'selected' : '' }}>Kantor Pusat</option>
                                    <option value="branch_office" {{ $location->type == 'branch_office' ? 'selected' : '' }}>Kantor Cabang</option>
                                    <option value="mine" {{ $location->type == 'mine' ? 'selected' : '' }}>Lokasi Pertambangan</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="region" :value="__('Wilayah / Region')" />
                                <x-text-input id="region" name="region" type="text" class="mt-1 block w-full" style="border: 1.5px solid #F07B3F;" :value="old('region', $location->region)" required />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.locations.index') }}" class="text-sm underline px-4" style="color: #2D4059;">Batal</a>
                            <x-primary-button style="background-color: #F07B3F; hover:background-color: #d66a33;">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
