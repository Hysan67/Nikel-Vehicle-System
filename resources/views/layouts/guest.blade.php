<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Fleet Management') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    <body class="antialiased min-h-screen flex flex-col sm:justify-center items-center pt-8 sm:pt-0 bg-[#EEEEEE] px-4 sm:px-0">
        <div class="mb-6 sm:mb-8">
            <a href="/" class="text-2xl sm:text-3xl font-extrabold tracking-wider uppercase border-l-4 border-[#F07B3F] pl-4 text-[#2D4059]">
                Fleet <span class="text-[#F07B3F]">Management</span>
            </a>
        </div>
        
        <div class="w-full sm:max-w-lg mt-4 sm:mt-6 px-6 py-8 sm:px-10 sm:py-12 bg-white border-t-4 border-[#2D4059] shadow-xl overflow-hidden sm:rounded-xl mb-8 sm:mb-0">
            {{ $slot }}
        </div>
    </body>
</html>
