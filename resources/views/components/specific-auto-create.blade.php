<div
    x-data="{show : false}"
    x-show="show"
    x-on:open-modal.window="show = true"
    x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="show = false"
    class="fixed z-50 inset-0"
    x-transition>

    <div x-on:click="show = false" class="fixed inset-0 bg-gray-300 opacity-40 scale-125"></div>

    <div class="rounded-xl bg-neutral-200 m-auto fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 max-w-2xl dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">

        <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
            <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 dark:text-white">
                Capítulo específico
            </h3>
            <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" x-on:click="show = false">
                <span class="sr-only">Close</span><ion-icon name="close-outline"></ion-icon>
            </button>
        </div>

        <form action="/blogadmin/posts/specific-auto-create" method="POST">
            @csrf
            <div class="p-4 overflow-y-auto">
                <div class="flex flex-col gap-3">
                    <div>
                        <label for="title" class="block text-sm font-medium mb-2 dark:text-white">Título</label>
                        <input type="text" name="title" class="text-input-default" placeholder="Título">
                    </div>
                    <div class="flex flex-row gap-3">
                        <div class="w-6/12">
                            <label for="title" class="block text-sm font-medium mb-2 dark:text-white">Página inicial</label>
                            <input type="number" name="pg-inicial" class="text-input-small" placeholder="Ex: 5">
                        </div>
                        <div class="w-6/12">
                            <label for="title" class="block text-sm font-medium mb-2 dark:text-white">Página final</label>
                            <input type="number" name="pg-final" class="text-input-small" placeholder="Ex: 9">
                        </div>
                    </div>
                </div>
                <p class="mt-1 text-gray-800 dark:text-neutral-400">
                    Insira o nome do capítulo na página em que ele está, a página em que ele começa e na qual o próximo capítulo se inicia
                </p>
            </div>
            <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" x-on:click="show = false">
                    Fechar
                </button>
                <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    Gerar post
                </button>
                <input type="hidden" name="book_id" value="{{ $bookId }}">
            </div>
        </form>
    </div>
</div>