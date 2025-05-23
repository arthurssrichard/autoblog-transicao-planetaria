<section class="p-10 dark:bg-neutral-950">
    <div>
        <h2 class="text-gray-600 text-6xl font-normal dark:text-gray-300">Postagens</h2>
    </div>
    <div class="w-full flex flex-col-reverse sm:flex-row gap-x-6">
        <!-- Post list -->
        <div class="flex flex-col justify-center items-start w-full sm:w-8/12">
            <div class="flex flex-col space-y-3 w-full pt-10">
                @foreach($posts as $post)
                @include('livewire/includes/post-card')
                @endforeach
            </div>
            <div class="my-3">
                {{$posts->links()}}
            </div>
        </div>
        <!-- Filter section -->
        <div class="flex flex-col justify-start w-full sm:w-3/12 gap-y-3 gap-x-2">
            <div class="w-full">
               <p class="text-base text-gray-600 dark:text-gray-400"><ion-icon class="scale-90 translate-y-0.5" name="funnel-outline" wire:ignore></ion-icon> Filtrar por:</p>
            </div>
            <div class="w-full bg-gray-50 p-4 rounded-lg shadow dark:bg-neutral-900">
                <label for="hs-select-label" class="block text-sm font-medium mb-2 dark:text-white">Busca</label>
                <div class="relative">
                    <input type="text" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-100 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block ps-8 pe-0" placeholder="Pesquise algo..." wire:model.live.debounce.300ms="search">
    
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        <ion-icon name="search-outline" class="dark:text-neutral-100" wire:ignore></ion-icon>
                    </div>
                </div>
            </div>
    
            <div class="grid grid-cols-2 sm:grid sm:grid-cols-1 gap-4">
                <div class="w-full bg-gray-50 p-4 rounded-lg shadow dark:bg-neutral-900">
                    <label for="hs-select-label" class="block text-sm font-medium mb-2 dark:text-white">Categoria</label>
                    <select id="hs-select-label" class="select-label" wire:model.live="category">
                        <option selected="" value="">Selecionar</option>
                        @foreach($categories as $category)
                        <option value="{{$category->slug}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full bg-gray-50 p-4 rounded-lg shadow dark:bg-neutral-900">
                    <label for="hs-select-label" class="block text-sm font-medium mb-2 dark:text-white">Ordenar por</label>
                    <select id="hs-select-label" class="select-label" name="" id="" wire:model.live="sort">
                        <option selected="" value="desc">Mais recente</option>
                        <option             value="asc">Mais antigo</option>
                    </select>
                </div>
            </div>

            {{--
            <div class="w-full bg-gray-50 p-4 rounded-lg shadow dark:bg-neutral-900">
                <label class="block text-sm font-medium mb-2 dark:text-white">Tags</label>
                <div class="relative">
                    <input type="email" class="peer py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" placeholder="Adicionar tag à busca">
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        <ion-icon name="pricetag-outline"></ion-icon>
                    </div>
                </div>
            </div>--}}
    
    
            <div class="w-full">
                <div class="flex items-center pl-5">
                    <label for="hs-medium-switch" class="text-sm font-semibold text-gray-500 me-3 dark:text-neutral-400">Mostrar apenas destacados</label>
    
                    <input type="checkbox" id="hs-medium-switch" wire:model.live="featured" class="relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent shadow text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-600
                    before:inline-block before:size-6 before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-neutral-400 dark:checked:before:bg-blue-200">
                </div>
            </div>
        </div>
    </div>
</section>
