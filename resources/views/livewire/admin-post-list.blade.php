<div class="flex flex-col rounded-lg border">
    <div class="p-4">
        <div class="relative lg:w-6/12 min-w-6/12">
            <input type="text" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block ps-8 pe-0" wire:model.live.debounce.300ms="search" placeholder="Pesquisar">

            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                <ion-icon name="search-outline" wire:ignore></ion-icon>
            </div>
        </div>
    </div>
    <div>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-100 dark:bg-neutral-700">
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Título</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Slug</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Categoria</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Tags</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Data de publicação</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Ação</th>
            </thead>
            <tbody> @foreach($posts as $post)
                <tr class="border-b">
                    <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800 dark:text-neutral-200 text-start text-ellipsis">
                        <a href="/admin/posts/{{$post->id}}/edit" wire:navigate class="hover:underline">{{$post->title}}</a>
                    </td>
                    <td class="px-6 py-4 whitespace-normal text-sm font-medium text-gray-800 dark:text-neutral-200 ">{{$post->slug}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-800 dark:text-neutral-200 text-start">
                        {{$post->category->name}}
                    </td>

                    <td class="px-6 py-4 whitespace-normal text-xs font-medium text-gray-800 dark:text-neutral-200 text-start">
                        @if($post->tags)
                        @foreach($post->tags as $tag)
                        <span class="border bg-yellow-50 border-yellow-200 rounded-full px-2 mr-1 mb-1 inline-block text-yellow-950 shadow-sm">{{$tag}}</span>
                        @endforeach
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 text-start">
                        {{date('d/m/Y'), strtotime($post->published_at)}}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 text-start">
                        <ion-icon name="trash-outline" class="text-red-500 text-xl" wire:ignore></ion-icon>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div class="flex justify-center p-4">
            <nav aria-label="Pagination" class="inline-flex items-center space-x-2">
                {{ $posts->links() }}
            </nav>
        </div>

    </div>
</div>