<section class="w-full px-10">
    <h2 class="mt-16 mb-5 text-3xl font-bold">Criar novo post</h2>
    <form action="" wire:submit="store">
        @csrf

        <div class="p-6 bg-white shadow-md rounded-lg mb-10">
            <div class="grid lg:grid-cols-2 lg:gap-6 sm:gap-4 mb-5">
                <div>
                    <label for="title" class="block text-sm font-medium mb-2 dark:text-white">Título</label>
                    <input type="text" class="text-input-default" wire:model="title">
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium mb-2 dark:text-white">Slug</label>
                    <input type="text" name="slug" id="slug" class="text-input-default" wire:model="slug">
                </div>
            </div>
            <div>
                <x-input.tinymce wire:model="mensagem" placeholder="Type anything you want..." />
            </div>
        </div>

        <!-- Image insertion or upload box -->
        <div class="p-6 bg-white shadow-md rounded-lg">
            <h3 class="text-2xl font-bold mb-2">Imagem</h3>

            <div class="grid lg:grid-cols-2 lg:gap-6 sm:gap-4 mb-5">

                <div class="relative flex flex-col items-center justify-center w-full h-80 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:bg-neutral-900 dark:border-neutral-700 dark:hover:bg-neutral-800 overflow-hidden">
                    <input type="file" id="file-upload" class="hidden" accept="image/*" onchange="handleFileChange(event)" wire:model="imageUpload">
                    <label for="file-upload" class="flex flex-col items-center justify-center h-full w-full text-gray-500 dark:text-neutral-400">
                        <ion-icon wire:ignore name="image-outline" class="text-4xl mb-2"></ion-icon>
                        <span class="text-sm font-medium">Arraste uma imagem ou clique para enviar</span>
                    </label>
                    @if($imageUpload && !$errors->has('imageUpload'))
                    <button type="button" wire:click="$set('imageUpload', null)" class="absolute top-2 right-2 z-10 hover:text-gray-300 text-white p-1">
                        <ion-icon name="trash-outline" class="text-lg"></ion-icon>
                    </button>
                        <img src="{{ $imageUpload->temporaryUrl() }}" alt="uploaded" class="object-cover">
                    @endif

                    @if($imageFromWeb && !$errors->has('imageFromWeb'))
                    <button type="button" wire:click="$set('imageFromWeb', null)" class="absolute top-2 right-2 z-10 hover:text-gray-300 text-white p-1">
                        <ion-icon name="trash-outline" class="text-lg"></ion-icon>
                    </button>
                        <img src="{{ $imageFromWeb['src']['original'] }}" alt="uploaded" class="object-cover">
                    @endif
                </div>

                <div class="flex flex-col items-center justify-center w-full h-80 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:bg-gray-100 dark:bg-neutral-900 dark:border-neutral-700 dark:hover:bg-neutral-800">
                    <ion-icon name="color-wand-outline" wire:ignore class="text-4xl mb-2"></ion-icon>
                    <span class="text-sm font-medium mb-2">Ou, pesquise no pexels ou gere sugestões com IA</span>
                    <div class="flex flex-row justify-center">
                        <div class="w-11/12 mr-2"><input wire:model="consulta" title="Deixe vazio para buscar com IA" placeholder="Deixe vazio para buscar com IA" class="text-input-small" type="text"></div>
                        <div class="w-1/12"><button class="btn-small-play" wire:click="generateImage" type="button"><ion-icon wire:ignore name="search-outline" class="text-lg"></ion-icon></button></div>
                    </div>
                </div>
            </div>

            @if($images)
            <div class="w-full">
                <h2>Sugestões de imagem para: {{$this->consulta}}</h2>
                <div id="pexels-images-box" class="flex flex-row w-full overflow-x-auto space-x-2 scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-neutral-700">
                    @foreach($images as $pexelImage)
                    <div class="relative flex-shrink-0">
                        <img src="{{$pexelImage['src']['tiny']}}" alt="{{$pexelImage['alt']}}" wire:click="toggleImage({{$pexelImage['id']}})" class="rounded-lg cursor-pointer">
                        <div class="absolute inset-0 bg-black bg-opacity-20 opacity-0 hover:opacity-100 transition-opacity duration-300 rounded-lg cursor-pointer" wire:click="toggleImage({{$pexelImage['id']}})"></div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2" type="submit">Adicionar</button>
    </form>
</section>