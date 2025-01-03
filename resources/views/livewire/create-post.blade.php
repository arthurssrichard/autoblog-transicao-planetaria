<section class="w-full px-10 py-16 dark:bg-neutral-900">
    <h2 class="mb-5 text-3xl font-bold dark:text-neutral-300">{{isset($post_id) ? "Editar post" : "Criar novo post"}}</h2>
    <form action="" wire:submit="store">
        @csrf

        <div class="p-6 bg-white shadow-md rounded-lg mb-10 dark:bg-neutral-800">
            <div class="grid lg:grid-cols-2 lg:gap-6 sm:gap-4 mb-5">
                <div>
                    <label for="title" class="block text-sm font-medium mb-2 dark:text-white">Título</label>
                    <input type="text" class="text-input-default" wire:model="title" placeholder="Digite o título">
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium mb-2 dark:text-white">Slug</label>
                    <input type="text" name="slug" id="slug" class="text-input-default" wire:model="slug" placeholder="Digite o slug">
                </div>
            </div>
            <div>
                <x-input.tinymce wire:model="mensagem" placeholder="Type anything you want..." />
            </div>
        </div>

        <!-- Image insertion or upload box -->
        <div class="p-6 bg-white shadow-md rounded-lg dark:bg-neutral-800">
            <h3 class="text-2xl font-bold mb-2 dark:text-neutral-300">Imagem</h3>

            <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6 mb-5"">

                <div class=" relative flex flex-col items-center justify-center w-full h-36 lg:h-80 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:bg-neutral-900 dark:border-neutral-700 dark:hover:bg-neutral-800 overflow-hidden">
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

                @if($image && !$errors->has('image'))
                <button type="button" wire:click="$set('imageFromWeb', null)" class="absolute top-2 right-2 z-10 hover:text-gray-300 text-white p-1">
                    <ion-icon name="trash-outline" class="text-lg"></ion-icon>
                </button>
                <img src="{{ $image }}" alt="uploaded" class="object-cover">
                @endif
            </div>

            <div class="flex flex-col items-center justify-center w-full h-36 lg:h-80  rounded-lg bg-gray-50  dark:bg-neutral-900 dark:border-neutral-700 ">
                <ion-icon name="color-wand-outline" wire:ignore class="text-4xl mb-2 dark:text-neutral-300"></ion-icon>
                <span class="text-sm font-medium mb-2 dark:text-neutral-300">Ou, pesquise no pexels ou gere sugestões com IA</span>
                <div class="flex flex-row justify-center">
                    <div class="w-11/12 mr-2"><input wire:model="consulta" title="Deixe vazio para buscar com IA" placeholder="Deixe vazio para buscar com IA" class="text-input-small" type="text"></div>
                    <div class="w-1/12"><button class="btn-small-play" wire:click="generateImage" type="button"><ion-icon wire:ignore name="search-outline" class="text-lg"></ion-icon></button></div>
                </div>
            </div>
        </div>

        @if($images)
        <div class="w-full">
            <h2 class="dark:text-neutral-400 mb-2">Sugestões de imagem para: {{$this->consulta}}</h2>
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

        <hr class="my-10 dark:border-neutral-600">

        <div class="flex flex-col">
            {{--Categorias e publicação--}}
            <div class="w-full">
                <div class="p-5 dark:bg-neutral-800 shadow-md rounded-lg grid lg:grid-cols-2 gap-4 mb-5">
                    <div class="w-full">
                        <h3 class="text-xl font-bold mb-2 dark:text-neutral-300">Categoria</h3>
                        <select wire:model="categoriaSelecionada" class="select-label" id="">
                            <option selected="" required>Categorias</option>
                            @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <h3 class="text-xl font-bold mb-2 dark:text-neutral-300">Tags</h3>
                        <div class="border dark:border-neutral-600 rounded-lg overflow-hidden">
                            <input type="text" class="h-6 w-full p-3 border-0 focus:outline-none text-base dark:text-neutral-400 dark:bg-neutral-900"
                                wire:keydown.prevent.enter="addTag" wire:model="currentTag" placeholder="Nova tag">
                            <div class="py-3 px-1.5 min-h-5 dark:border-neutral-600 border-t dark:bg-neutral-900">
                                @if($tags)
                                @foreach($tags as $index => $tag)
                                <button type="button" class="py-0.5 px-2 inline-flex items-center mb-1 gap-x-1 text-sm rounded-xl border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:text-white dark:border-neutral-700 dark:hover:bg-neutral-800">
                                    <ion-icon wire:ignore name="close-outline" wire:click="removeTag({{$index}})"></ion-icon>
                                    {{$tag}}
                                </button>
                                @endforeach
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="p-6 mt-5 rounded-lg grid lg:grid-cols-2 gap-4">

                    <div>
                        <h3 class="text-xl font-bold mb-2 dark:text-neutral-300">Publicação</h3>
                        <div class="flex flex-row flex-wrap justify-start gap-2">
                            <div class="flex flex-row space-x-2">
                                <input type="date" class="px-3 block border-gray-200 rounded-lg dark:bg-neutral-900 dark:text-neutral-400 dark:border-neutral-600" wire:model.lazy="date">
                                <input type="time" class="px-3 block border-gray-200 rounded-lg dark:bg-neutral-900 dark:text-neutral-400 dark:border-neutral-600" wire:model.lazy="time">
                            </div>
                            <button class="btn-small bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700" type="submit">
                                {{ (strtotime($this->date . ' ' . $this->time) === strtotime(date('Y-m-d H:i'))) ? "Publicar agora" : "Agendar" }}
                            </button>
                        </div>
                        @if($testImage)
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="hs-basic-with-description-unchecked" wire:model="togglePostWithInstagram" class="default-toggle">
                            <label for="hs-basic-with-description-unchecked" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Publicar também no Instagram</label>
                        </div>
                        @endif
                    </div>


                    @if(!$testImage)
                    <div class="flex flex-row justify-start lg:justify-center items-center">
                        <button wire:click="generateInstagramPost" class="btn-small-play" type="button">
                            <ion-icon class="text-lg" name="logo-instagram" wire:ignore></ion-icon> Gerar postagem do Instagram
                        </button>
                    </div>
                    @endif

                    @if($testImage)
                    {{--Post do instagram--}}
                    <div class="p-6 mt-5 bg-white dark:bg-neutral-800 shadow-md rounded-lg">
                        <div class="overflow-hidden mb-3 max-w-[600px]"><img class="rounded-xl object-cover" src="{{ 'data:image/jpeg;base64,'.$testImage }}" alt="Imagem manipulada"></div>
                        <div class="space-y-3">
                            <textarea class="py-3 px-4 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:bg-neutral-900" placeholder="Descrição do post" wire:model="instagramDescription"></textarea>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</section>