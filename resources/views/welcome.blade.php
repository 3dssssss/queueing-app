<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif

            <img class="img-profile rounded-circle"
            src="{{ asset('images/undraw_wait-in-line.svg') }}">

            <div class="text-center mt-4">
            <h1 class="text-xl font-bold text-white">Queueing System</h1>
            <p class="text-l text-gray-500">Manage your queues efficiently and effectively.</p>        
        </div>

            
        </div>
    </body>
</html>
