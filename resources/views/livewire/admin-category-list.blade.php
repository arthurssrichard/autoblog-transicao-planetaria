<div class="flex flex-col rounded-lg border dark:border-neutral-500">
    @if(session()->has('error'))
    <x-error-alert title="Erro" message="{{ session('error') }}" />
    @endif
    <div class="p-4">
        <div class="relative lg:w-6/12 min-w-6/12">
            <input type="text" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-950 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 ps-8 pe-0" wire:model.live.debounce.300ms="search" placeholder="Pesquisar">

            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                <ion-icon class="dark:text-neutral-400" name="search-outline" wire:ignore></ion-icon>
            </div>
        </div>
    </div>
    <div class="dark:bg-neutral-800">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-100 dark:bg-neutral-900">
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 table-cell sm:table-cell">Nome</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 table-cell sm:table-cell">Slug</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 hidden sm:table-cell">Cor</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 hidden sm:table-cell">Ação</th>
            </thead>

            <tbody> @foreach($categories as $category)
                <tr class="border-b dark:border-neutral-500">
                    <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800 dark:text-neutral-300 text-start text-ellipsis table-cell sm:table-cell">
                        <a href="/blogadmin/categories/{{$category->id}}/edit" wire:navigate class="hover:underline">{{$category->name}}</a>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-800 dark:text-neutral-300 text-start table-cell sm:table-cell">
                        {{$category->slug}}
                    </td>

                    <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800 dark:text-neutral-300 hidden sm:table-cell">
                        <div class="rounded-lg w-6/12 sm:w-10/12" style="height: 40px; background-color: {{$category->color;}}"></div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-300 text-start hidden sm:table-cell">
                        <button x-data x-on:click="$dispatch('open-modal'); $dispatch('update-message', 'Caso apague a categoria {{$category->name}}, todos os posts serão movidos para Sem categoria.')"
                                wire:click="setDelete({{$category->id}})">
                            <ion-icon wire:ignore name="trash-outline" class="text-red-500 text-xl"></ion-icon>
                        </button>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>

        <x-confirm-action-modal x-data="{ show: false, message: '' }"
            x-on:open-modal.window="show = true"
            x-on:close-modal.window="show = false"
            x-on:update-message.window="message = $event.detail" />
        {{--@include('livewire/confirm-action-modal')--}}
        <div class="flex justify-center p-4">
            <nav aria-label="Pagination" class="inline-flex items-center space-x-2">
                {{ $categories->links() }}
            </nav>
        </div>

    </div>
</div>