<div class="flex flex-col rounded-lg border">
    @if(session()->has('error'))
        <x-error-alert title="Erro" message="{{ session('error') }}"/>
    @endif
    <div class="p-4">
        <div class="relative lg:w-6/12 min-w-6/12">
            <input type="text" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 ps-8 pe-0" wire:model.live.debounce.300ms="search" placeholder="Pesquisar">

            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                <ion-icon name="search-outline" wire:ignore></ion-icon>
            </div>
        </div>
    </div>
    <div>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-100 dark:bg-neutral-700">
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Nome</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Slug</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Cor</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Ação</th>
            </thead>
            <tbody> @foreach($categories as $category)
                <tr class="border-b">
                    <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800 dark:text-neutral-200 text-start text-ellipsis">
                        <a href="/blogadmin/categories/{{$category->id}}/edit" wire:navigate class="hover:underline">{{$category->name}}</a>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-800 dark:text-neutral-200 text-start">
                        {{$category->slug}}
                    </td>

                    <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800 dark:text-neutral-200 ">
                        <div class="rounded-lg w-6/12 sm:w-10/12" style="height: 40px; background-color: {{$category->color;}}"></div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 text-start">
                        <button wire:click="delete({{$category->id}})">
                            <ion-icon name="trash-outline" class="text-red-500 text-xl" wire:ignore></ion-icon>
                        </button>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div class="flex justify-center p-4">
            <nav aria-label="Pagination" class="inline-flex items-center space-x-2">
                {{ $categories->links() }}
            </nav>
        </div>

    </div>
</div>