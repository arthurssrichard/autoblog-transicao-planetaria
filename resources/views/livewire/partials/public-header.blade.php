<header class="flex items-center justify-between py-3 px-8 sm:px-20 border-b border-gray-100 dark:border-gray-700">
        <div class="flex flex-row justify-between items-center w-full">

            {{-- terminar controles de mostrar/esconder menu com o mesmo conceito do modal com alpinejs --}}
            <div class="text-gray-800 font-semibold w-6/12 sm:w-32">
                <img 
                class="w-full" 
                x-data="{ isDark: window.matchMedia('(prefers-color-scheme: dark)').matches }"
                x-init="window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => isDark = e.matches)"
                :src="isDark ? '/optimized-image/logo-dark.png' : '/optimized-image/logo.png'" 
                alt="logo">
            </div>
            <x-public-header-mobile></x-public-header-mobile>
            <div class="w-6/12 sm:w-6/12 flex justify-end">
                <div class="flex sm:hidden cursor-pointer">
                    <button x-data x-on:click="$dispatch('open-header-mobile')">
                        <ion-icon name="menu-outline" class="text-4xl text-neutral-300"></ion-icon>
                    </button>
                </div>
                <ul class="sm:flex hidden space-x-4">
                    <li>
                        <a class="flex space-x-2 items-center text-md hover:text-teal-500 {{ $this->isActive('/') }}" href="/" wire:navigate>
                            Home
                        </a>
                    </li>

                    <li>
                        <a class="flex space-x-2 items-center text-md hover:text-teal-500  {{ $this->isActive('posts') }}" href="/posts" wire:navigate>
                            Blog
                        </a>
                    </li>

                    <li>
                        <a class="flex space-x-2 items-center text-md hover:text-teal-500  {{ $this->isActive('sobre-nos') }}" href="/sobre-nos" wire:navigate>
                            Sobre nós
                        </a>
                    </li>

                    <li>
                        <a class="flex space-x-2 items-center text-md hover:text-teal-500  {{ $this->isActive('contato') }}" href="/contato" wire:navigate>
                            Contato
                        </a>
                    </li>

                    <li>
                        <a class="flex space-x-2 items-center text-md hover:text-teal-500  {{ $this->isActive('introducao') }}" href="/introducao" wire:navigate>
                            Introdução
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </header>