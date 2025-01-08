<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="font-light antialiased dark:bg-neutral-900">
    <livewire:partials.public-header>
    @yield('content')
    <footer class="text-sm space-x-4 flex items-center border-t border-gray-100 flex-wrap justify-center py-4 ">
        <a class="text-gray-500 hover:text-yellow-500" href="">About Us</a>
        <a class="text-gray-500 hover:text-yellow-500" href="">Help</a>
        <a class="text-gray-500 hover:text-yellow-500" href="">Login</a>
        <a class="text-gray-500 hover:text-yellow-500" href="">Explore</a>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>