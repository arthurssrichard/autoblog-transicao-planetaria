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
    <footer class="text-sm border-t border-gray-100 dark:border-gray-700 dark:bg-neutral-950">
        <div class="space-x-4 flex items-center flex-wrap justify-center py-4 font-normal">
            <a class="text-gray-500 hover:text-teal-500" wire:navigate href="">Termos de uso</a>
            <a class="text-gray-500 hover:text-teal-500" wire:navigate href="">Política de privacidade</a>
            <a class="text-gray-500 hover:text-teal-500" wire:navigate href="">Contato</a>
        </div>
        <div class="py-4 flex justify-center">
            <span class="text-gray-500 text-xs">Criado por <a class="hover:text-teal-500" href="https://github.com/arthurssrichard" wire:navigate>Arthur Richard</a></span>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @livewireScripts
</body>