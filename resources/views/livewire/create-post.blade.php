<div class="mb-10">
    <h2 class="mt-16 mb-5 text-3xl text-yellow-900 font-bold">Novo post</h2>
    <form action="" wire:submit="store">
        @csrf
        <div>
            <label for="title">Título</label>
            <input type="text" id="title" class="bg-gray-50 border" wire:model="title">
        </div>
        <div>
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="bg-gray-50 border" wire:model="slug">
        </div>
        <div>
            <x-input.tinymce wire:model="mensagem" placeholder="Type anything you want..." />
        </div>
        @if($images)
        <div>
            <h2>Imagens sugeridas:</h2>
            <div id="pexels-images-box" class="flex">
                @foreach($images as $pexelImage)
                <div>
                    <img src="{{$pexelImage['src']['tiny']}}" alt="{{$pexelImage['alt']}}" wire:click="toggleImage({{$pexelImage['id']}})" class="rounded shadow-sm">
                </div>
                @endforeach
            </div>
        </div>
        @endif
        <div>
            <h2>Adicionar imagem</h2>
            <label for="image">Imagem do post:</label>
            <input type="file" id="image" wire:model="imageUpload">

            @if($imageUpload && !$errors->has('imageUpload'))
                <img src="{{ $imageUpload->temporaryUrl() }}" alt="uploaded" class="rounded shadow-sm">
            @endif

            @if($imageFromWeb && !$errors->has('imageFromWeb'))
                <img src="{{ $imageFromWeb['src']['tiny'] }}" alt="uploaded" class="rounded shadow-sm">
            @endif

        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2" wire:click="generateImage" type="button">Gerar imagem</button>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2" type="submit">Adicionar</button>
    </form>
</div>