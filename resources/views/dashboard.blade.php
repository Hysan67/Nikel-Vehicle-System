<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-lg sm:text-xl leading-tight uppercase tracking-wider" style="color: #2D4059;">
            Vehicle Monitoring Dashboard
        </h2>
    </x-slot>

    <div class="py-6 sm:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="overflow-hidden shadow-md rounded-lg p-5 sm:p-6" style="background-color: #ffffff; border-left: 7px solid #2D4059;">
                    <div class="text-xs font-bold uppercase tracking-wider mb-1" style="color: #2D4059;">Total Kendaraan</div>
                    <div class="mt-2 flex items-baseline">
                        <div class="text-3xl font-bold" style="color: #2D4059;">{{ $stats['total_vehicles'] }}</div>
                        <div class="ml-2 text-sm font-medium" style="color: #F07B3F;">Unit</div>
                    </div>
                </div>
                <div class="overflow-hidden shadow-md rounded-lg p-5 sm:p-6" style="background-color: #ffffff; border-left: 7px solid #4CAF50;">
                    <div class="text-xs font-bold uppercase tracking-wider mb-1" style="color: #2D4059;">Pemesanan Aktif</div>
                    <div class="mt-2 flex items-baseline">
                        <div class="text-3xl font-bold" style="color: #2D4059;">{{ $stats['active_bookings'] }}</div>
                        <div class="ml-2 text-sm font-medium" style="color: #F07B3F;">Terdaftar</div>
                    </div>
                </div>
                <div class="overflow-hidden shadow-md rounded-lg p-5 sm:p-6" style="background-color: #ffffff; border-left: 7px solid #F07B3F;">
                    <div class="text-xs font-bold uppercase tracking-wider mb-1" style="color: #2D4059;">Driver Tersedia</div>
                    <div class="mt-2 flex items-baseline">
                        <div class="text-3xl font-bold" style="color: #2D4059;">{{ $stats['total_drivers'] }}</div>
                        <div class="ml-2 text-sm font-medium" style="color: #F07B3F;">Orang</div>
                    </div>
                </div>
            </div>

            {{-- Charts Section --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
                {{-- Usage Chart --}}
                <div class="overflow-hidden shadow-md rounded-lg p-5 sm:p-6" style="background-color: #ffffff; border-top: 4px solid #2D4059;">
                    <h3 class="text-sm font-bold uppercase tracking-wider mb-4" style="color: #2D4059;">Intensitas Pemakaian (Bulan)</h3>
                    <div style="height: 220px;">
                        <canvas id="usageChart"></canvas>
                    </div>
                </div>

                {{-- Fuel Chart --}}
                <div class="overflow-hidden shadow-md rounded-lg p-5 sm:p-6" style="background-color: #ffffff; border-top: 4px solid #F07B3F;">
                    <h3 class="text-sm font-bold uppercase tracking-wider mb-4" style="color: #2D4059;">Konsumsi BBM (Liter)</h3>
                    <div style="height: 220px;">
                        <canvas id="fuelChart"></canvas>
                    </div>
                </div>

                {{-- Service Cost Chart --}}
                <div class="md:col-span-2 overflow-hidden shadow-md rounded-lg p-5 sm:p-6" style="background-color: #ffffff; border-top: 4px solid #FFD460;">
                    <h3 class="text-sm font-bold uppercase tracking-wider mb-4" style="color: #2D4059;">Total Pengeluaran Servis (Rp)</h3>
                    <div style="height: 220px;">
                        <canvas id="serviceChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Activity Logs --}}
            <div class="overflow-hidden shadow-md rounded-lg mb-6 sm:mb-8" style="background-color: #ffffff;">
                <div class="p-5 sm:p-6">
                    <h3 class="text-base font-bold mb-4" style="color: #2D4059; border-bottom: 2px solid #F07B3F; padding-bottom: 8px;">Log Aktivitas Terbaru</h3>
                    <div class="space-y-3">
                        @foreach($stats['recent_activities'] as $log)
                        <div class="flex items-center p-3 rounded-lg transition duration-150 ease-in-out" style="border-bottom: 1px solid #EEEEEE;" onmouseover="this.style.backgroundColor='#EEEEEE';" onmouseout="this.style.backgroundColor='';">
                            <div class="flex-shrink-0 w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center" style="background-color: #EEEEEE;">
                                <span class="text-xs font-bold" style="color: #2D4059;">{{ substr($log->action, 0, 1) }}</span>
                            </div>
                            <div class="ml-3 sm:ml-4 flex-1 min-w-0">
                                <div class="text-sm font-semibold truncate" style="color: #2D4059;">{{ $log->action }}</div>
                                <div class="text-xs truncate" style="color: #2D4059;">{{ $log->description }}</div>
                            </div>
                            <div class="ml-3 sm:ml-4 text-right shrink-0">
                                <div class="text-xs font-medium" style="color: #F07B3F;">{{ $log->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <a href="{{ route('reports.index') }}" class="block p-5 sm:p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 group" style="background-color: #2D4059; border-top: 4px solid #F07B3F;">
                    <h4 class="font-bold text-base sm:text-lg mb-2 group-hover:translate-x-1 transition-transform" style="color: #EEEEEE;">Laporan Periodik</h4>
                    <p class="text-sm" style="color: #EEEEEE; opacity: 0.8;">Lihat dan ekspor riwayat pemakaian kendaraan dalam format Excel.</p>
                </a>
                @can('is-admin')
                <a href="{{ route('admin.vehicles.index') }}" class="block p-5 sm:p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 group" style="background-color: #2D4059; border-top: 4px solid #F07B3F;">
                    <h4 class="font-bold text-base sm:text-lg mb-2 group-hover:translate-x-1 transition-transform" style="color: #EEEEEE;">Manajemen Armada</h4>
                    <p class="text-sm" style="color: #EEEEEE; opacity: 0.8;">Kelola armada perusahaan, termasuk data kendaraan milik sendiri dan sewa.</p>
                </a>
                @endcan
            </div>

        </div>
    </div>

    {{-- Chart.js Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const chartData = @json($chartData);

            // Usage Chart (Bar)
            new Chart(document.getElementById('usageChart'), {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Total Perjalanan',
                        data: chartData.bookings,
                        backgroundColor: '#2D4059',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });

            // Fuel Chart (Line)
            new Chart(document.getElementById('fuelChart'), {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Total BBM (Liter)',
                        data: chartData.fuel,
                        borderColor: '#F07B3F',
                        backgroundColor: 'rgba(240, 123, 63, 0.2)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });

            // Service Chart (Bar)
            new Chart(document.getElementById('serviceChart'), {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Biaya Servis (Rp)',
                        data: chartData.service,
                        backgroundColor: '#FFD460',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
