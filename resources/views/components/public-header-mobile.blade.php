<section
    x-data="{ show: false }"
    x-show="show"
    x-on:open-header-mobile.window="show = true"
    x-on:close-header-mobile.window="show = false"
    x-on:keydown.escape.window="show = false"
    x-transition.opacity.duration.300ms
    x-cloak
    class="fixed inset-0 z-50 bg-white dark:bg-neutral-900"
>
    <div class="flex flex-col w-full h-full">
        <!-- Header Close Button -->
        <div class="flex justify-end p-8 h-40">
            <button
                x-on:click="show = false"
                class="text-gray-600 hover:text-gray-800 text-2xl"
            >
                <ion-icon name="close-outline" class="text-4xl text-neutral-300"></ion-icon>
            </button>
        </div>
 
        <!-- Navigation Links -->
        <div class="flex flex-col items-start justify-start flex-grow">
            <ul class="text-start w-full">
                <li class="border-b border-neutral-200 dark:border-neutral-600 p-5">
                    <a href="/" class="text-2xl hover:text-teal-500 {{ $this->isActive('/') }}" wire:navigate>Home</a>
                </li>
                <li class="border-b border-neutral-200 dark:border-neutral-600 p-5">
                    <a href="/posts" class="text-2xl hover:text-teal-500 {{ $this->isActive('posts') }}" wire:navigate>Blog</a>
                </li>
                <li class="border-b border-neutral-200 dark:border-neutral-600 p-5">
                    <a href="/sobre-nos" class="text-2xl hover:text-teal-500 {{ $this->isActive('sobre-nos') }}" wire:navigate>Sobre nós</a>
                </li>
                <li class="border-b border-neutral-200 dark:border-neutral-600 p-5">
                    <a href="/contato" class="text-2xl hover:text-teal-500 {{ $this->isActive('contato') }}" wire:navigate>Contato</a>
                </li>
                <li class="border-b border-neutral-200 dark:border-neutral-600 p-5">
                    <a href="/introducao" class="text-2xl hover:text-teal-500 {{ $this->isActive('introducao') }}" wire:navigate>Introdução</a>
                </li>
            </ul>
        </div>
    </div>
</section>
