<section class="w-full px-10 py-16">
    <h2 class="mb-5 text-3xl font-bold dark:text-neutral-300">{{$categoryId ? "Editar categoria '$name'" : "Criar nova categoria"}}</h2>
    <form wire:submit="submit">
        @csrf
        <div class="p-6 bg-white dark:bg-neutral-800 shadow-md rounded-lg mb-10">
            <div class="grid lg:grid-cols-3 gap-6 mb-5">
                <div>
                    <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Nome</label>
                    <input type="text" class="text-input-default" wire:model="name" wire:keyup="generateSlug" id="name" placeholder="Nome da categoria">
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium mb-2 dark:text-white">Slug</label>
                    <input type="text" id="slug" class="text-input-default" wire:model="slug" placeholder="slug-da-categoria">
                </div>
                <div class="flex flex-row space-x-10 items-end">
                    <div>
                        <label for="hs-color-input" class="block text-sm font-medium mb-2 dark:text-white">Cor</label>
                        <input type="color" class="p-1 h-10 w-14 block bg-white border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700" id="hs-color-input" value="#2563eb" title="Escolha a cor da categoria" wire:model="color">
                    </div>
                    <button class="btn-default bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700">{{$categoryId ? "Editar" : "Adicionar"}}</button>                
                </div>
            </div>
        </div>
    </form>
</section>