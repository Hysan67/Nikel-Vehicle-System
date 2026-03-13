<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Vehicle Monitoring System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        <script src="https://cdn.tailwindcss.com"></script>
        
        <style>
            body { font-family: 'Instrument Sans', sans-serif; background-color: #EEEEEE; color: #2D4059; }
            .bg-primary { background-color: #2D4059; }
            .text-primary { color: #2D4059; }
            .bg-accent { background-color: #F07B3F; }
            .text-accent { color: #F07B3F; }
            .bg-highlight { background-color: #FFD460; }
            .border-primary { border-color: #2D4059; }
            .border-accent { border-color: #F07B3F; }
        </style>
    </head>
    <body class="antialiased min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-primary text-[#EEEEEE] py-4 px-6 md:px-12 shadow-md">
            <div class="max-w-7xl mx-auto flex justify-between items-center gap-4">
                <div class="text-base sm:text-xl font-bold tracking-wider uppercase border-l-4 border-accent pl-3 shrink-0">
                    Fleet <span class="text-accent">Management</span>
                </div>
                
                @if (Route::has('login'))
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-medium hover:text-accent transition duration-150">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-medium hover:text-accent transition duration-150">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-accent text-white px-4 py-2 rounded-md font-bold hover:bg-opacity-90 transition duration-150 shadow-sm text-sm">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </nav>

        <main class="flex-grow flex items-center justify-center p-4 sm:p-6 md:p-12">
            <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-xl overflow-hidden flex flex-col md:flex-row w-full border-t-4 border-accent">
                <!-- Content Side -->
                <div class="flex-1 p-6 sm:p-8 md:p-12 lg:p-16 flex flex-col justify-center">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-primary mb-4 md:mb-6 leading-tight">
                        Vehicle Monitoring <br/> System
                    </h1>
                    <p class="text-sm sm:text-base text-gray-600 mb-6 md:mb-8 leading-relaxed">
                        Comprehensive monitoring and management for fleet operations, bookings, and service schedules across all Sekawan Nickel mining locations and regional offices.
                    </p>

                    <div class="flex justify-center md:justify-start">
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-primary text-[#EEEEEE] font-bold text-base px-8 py-3 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 border-b-4 border-accent">
                            Get Started
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Graphic Side -->
                <div class="hidden md:flex flex-1 bg-primary relative overflow-hidden items-center justify-center p-12">
                    <!-- Abstract graphic matching the theme colors -->
                    <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#EEEEEE 2px, transparent 2px); background-size: 30px 30px;"></div>
                    
                    <!-- Decorative elements -->
                    <div class="absolute top-10 right-10 w-32 h-32 bg-accent rounded-full opacity-50 blur-2xl"></div>
                    <div class="absolute bottom-10 left-10 w-40 h-40 bg-highlight rounded-full opacity-40 blur-2xl"></div>
                    
                    <div class="relative z-10 w-full max-w-sm bg-white p-6 rounded-lg shadow-2xl border-l-4 border-accent transform rotate-2 hover:rotate-0 transition duration-300">
                        <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-4">
                            <div class="flex items-center gap-3">
                                <div>
                                    <div class="font-bold text-primary">Fleet Dashboard</div>
                                    <div class="text-xs text-gray-500">Live Status</div>
                                </div>
                            </div>
                            <div class="px-2 py-1 bg-green-100 text-[#4CAF50] text-[#2D4059] text-[10px] font-bold rounded uppercase tracking-wider border border-[#4CAF50]">
                                Online
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mb-5">
                            <div class="bg-[#EEEEEE] bg-opacity-50 p-3 rounded-lg border-l-2 border-primary">
                                <div class="text-[10px] text-primary uppercase font-bold tracking-wider mb-1">Total Vehicles</div>
                                <div class="text-2xl font-black text-primary">{{ $stats['total_vehicles'] }}</div>
                            </div>
                            <div class="bg-[#EEEEEE] bg-opacity-50 p-3 rounded-lg border-l-2 border-accent">
                                <div class="text-[10px] text-primary uppercase font-bold tracking-wider mb-1">Active Bookings</div>
                                <div class="text-2xl font-black text-primary">{{ $stats['active_bookings'] }}</div>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="bg-[#EEEEEE] bg-opacity-50 p-3 rounded-lg border-l-2 border-accent">
                                <div class="text-[10px] text-primary uppercase font-bold tracking-wider mb-1">Driver Available</div>
                                <div class="text-2xl font-black text-primary">{{ $stats['total_drivers'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
