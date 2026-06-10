<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-seo-meta :meta="$meta" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=Barlow+Condensed:wght@600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col font-sans bg-black text-white overflow-x-hidden w-full">
    <x-public-navbar />

    <main class="flex-1">
        {{ $slot }}
    </main>

    <x-public-footer />
    <x-mobile-sticky-bar />

    @livewireScripts
    @stack('scripts')
</body>
</html>
