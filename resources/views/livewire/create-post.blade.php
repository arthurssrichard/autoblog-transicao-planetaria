<div class="mb-10">
    <h2 class="mt-16 mb-5 text-3xl text-yellow-900 font-bold">Novo post</h2>
    <form action="/posts" method="POST">
        @csrf
        <div>
            <label for="title">Título</label>
            <input type="text" id="title" class="bg-gray-50 border" wire:model="title">
        </div>
        <div>
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="bg-gray-50 border"
                value="{{isset($slug) ? $slug : ''}}">
        </div>
        <textarea name="body">
              @if(isset($mensagem))
                {{$mensagem}}
              @endif
        </textarea>
        <h2 wire:model="consulta"></h2>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2" wire:click="generateImage" type="button">Gerar imagem</button>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2" type="submit">Adicionar</button>
    </form>
</div>