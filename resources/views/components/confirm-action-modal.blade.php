<div x-data="{ show : false, message: '' }"
    x-show="show"
    x-on:open-modal.window="show = true"
    x-on:close-modal.window="show = false"
    x-on:update-message.window="message = $event.detail"
    x-on:keydown.escape.window="show = false"
    class="fixed z-50 inset-0"
    x-transition>

    <div x-on:click="show = false" class="fixed inset-0 bg-gray-300 opacity-40 scale-125"></div>

    <div class="rounded-xl bg-neutral-200 m-auto fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 max-w-2xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">

        <div class="flex justify-end items-center py-3 px-4 border-b dark:border-neutral-700">
            <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" x-on:click="show = false">
                <span class="sr-only">Close</span><ion-icon wire:ignore name="close-outline"></ion-icon>
            </button>
        </div>

        <div class="flex justify-center">
            <div class="p-1 sm:p-4 overflow-y-auto flex flex-col items-center w-8/12">
                <ion-icon class="text-6xl text-red-400" name="alert-circle-outline" wire:ignore></ion-icon>
                <div class="space-y-1">
                    <h3 class="text-xl font-black dark:text-neutral-300">Tem certeza que quer continuar?</h3>
                    <p class="text-sm text-neutral-600 dark:text-neutral-400" x-text="message"></p>
                </div>
            </div>
        </div>

        <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
            <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" x-on:click="show = false">
                Fechar
            </button>
            <button wire:click="delete" type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                Prosseguir
            </button>
        </div>
    </div>
</div>
