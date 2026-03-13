<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl leading-tight" style="color: #2D4059;">
                {{ __('Daftar Lokasi (Kantor / Tambang)') }}
            </h2>
            <a href="{{ route('admin.locations.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150" style="background-color: #2D4059; hover:background-color: #3b5375;">
                Tambah Lokasi
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
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Nama Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Wilayah</th>
                                <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider" style="color: #EEEEEE;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" style="border-color: #EEEEEE;">
                            @foreach($locations as $location)
                            <tr onmouseover="this.style.backgroundColor='#EEEEEE';" onmouseout="this.style.backgroundColor='';">
                                <td class="px-6 py-4 text-sm font-medium" style="color: #2D4059;">{{ $location->name }}</td>
                                <td class="px-6 py-4 text-sm capitalize" style="color: #2D4059;">
                                    <span class="px-2 py-1 rounded-full text-xs font-bold" style="background-color: #FFD460; color: #2D4059;">
                                        {{ str_replace('_', ' ', $location->type) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm" style="color: #2D4059;">{{ $location->region }}</td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <a href="{{ route('admin.locations.edit', $location->id) }}" class="font-semibold hover:underline" style="color: #F07B3F;">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $locations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
