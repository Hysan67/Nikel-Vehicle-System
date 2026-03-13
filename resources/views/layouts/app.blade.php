<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Fleet Management') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Tom Select -->
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

        <style>
            body { font-family: 'Instrument Sans', sans-serif; background-color: #EEEEEE; color: #2D4059; }
            .bg-primary { background-color: #2D4059; }
            .text-primary { color: #2D4059; }
            .bg-accent { background-color: #F07B3F; }
            .text-accent { color: #F07B3F; }
            .bg-highlight { background-color: #FFD460; }
            .border-primary { border-color: #2D4059; }
            .border-accent { border-color: #F07B3F; }
            
            /* Tom Select Earthy Override */
            .ts-control { border: 1.5px solid #F07B3F !important; border-radius: 0.375rem !important; padding: 0.5rem 0.75rem !important; }
            .ts-dropdown { border: 1.5px solid #F07B3F !important; border-radius: 0.375rem !important; margin-top: 4px !important; }
            .ts-dropdown .active { background-color: #FFD460 !important; color: #2D4059 !important; }
            .ts-dropdown .option:hover { background-color: #EEEEEE !important; }
        </style>
    </head>
    <body class="antialiased min-h-screen" style="background-color: #EEEEEE; color: #2D4059;">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @isset($header)
                <header style="background-color: #ffffff; border-bottom: 3px solid #F07B3F;">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
