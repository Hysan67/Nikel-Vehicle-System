<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Driver') }} : {{ $driver->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="name" :value="__('Nama Lengkap')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $driver->name)" required />
                        </div>
                        <div>
                            <x-input-label for="phone" :value="__('No. Telepon')" />
                            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $driver->phone)" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Status Driver')" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="available" {{ $driver->status == 'available' ? 'selected' : '' }}>Tersedia</option>
                                <option value="in_use" {{ $driver->status == 'in_use' ? 'selected' : '' }}>Sedang Berjalan</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.drivers.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline decoration-indigo-500 px-4">Batal</a>
                            <x-primary-button class="ml-4 bg-[#F07B3F] hover:bg-[#d66a33]">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
