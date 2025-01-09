<nav>
    <ul class="text-4xl text-yellow-500 dark:text-yellow-600 flex flex-col gap-y-3 py-4 items-center">
        <a href="/blogadmin/posts" wire:navigate>
            <li class="p-2 hover:bg-gray-300 dark:hover:bg-gray-900 hover:rounded-xl dark:hover:text-yellow-500 {{ $this->isActive('blogadmin/posts') }}">
                <ion-icon name="document-text"></ion-icon>
            </li>
        </a>

        <a href="/blogadmin/categories" wire:navigate>
            <li class="p-2 hover:bg-gray-300 dark:hover:bg-gray-900 hover:rounded-xl dark:hover:text-yellow-500 {{ $this->isActive('blogadmin/categories') }}">
                <ion-icon name="file-tray"></ion-icon>
            </li>
        </a>

        <a href="/blogadmin/books" wire:navigate>
            <li class="p-2 hover:bg-gray-300 dark:hover:bg-gray-900 hover:rounded-xl dark:hover:text-yellow-500 {{ $this->isActive('blogadmin/books') }}">
                <ion-icon name="book"></ion-icon>
            </li>
        </a>

    </ul>
</nav>