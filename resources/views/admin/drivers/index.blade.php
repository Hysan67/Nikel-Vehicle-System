<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Driver / Pengemudi') }}
            </h2>
            <a href="{{ route('admin.drivers.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                Tambah Driver
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase" style="color: #EEEEEE;">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase" style="color: #EEEEEE;">Telepon</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase" style="color: #EEEEEE;">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-bold uppercase" style="color: #EEEEEE;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="border-color: #EEEEEE;">
                            @foreach($drivers as $driver)
                            <tr onmouseover="this.style.backgroundColor='#EEEEEE';" onmouseout="this.style.backgroundColor='';">
                                <td class="px-6 py-4" style="color: #2D4059;">{{ $driver->name }}</td>
                                <td class="px-6 py-4" style="color: #2D4059;">{{ $driver->phone ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-bold rounded-full" 
                                          style="{{ $driver->status == 'available' ? 'background-color: #4CAF50; color: #EEEEEE;' : 'background-color: #F07B3F; color: #EEEEEE;' }}">
                                        {{ $driver->status == 'available' ? 'Tersedia' : 'Sedang Berjalan' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="font-semibold hover:underline" style="color: #F07B3F;">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $drivers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
