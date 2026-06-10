<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | A1 Training Group</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @wireuiScripts
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex h-screen">
        <x-admin-sidebar />
        <main class="flex-1 overflow-y-auto p-8">{{ $slot }}</main>
    </div>
    <x-notifications />
    @livewireScripts
</body>
</html>
