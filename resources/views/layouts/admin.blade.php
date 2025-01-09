<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="font-light antialiased dark:bg-neutral-900 flex flex-row">
    <aside class="h-screen flex flex-col transition-all duration-300 ease-in-out bg-neutral-100 dark:bg-neutral-950 lg:w-[6%] w-[15%] sticky top-0 rounded-r-xl sm:shadow-md">
        <livewire:partials.admin-sidebar/>
    </aside>
    <main class="h-full lg:w-[94%] w-[85%]">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @livewireScripts
</body>