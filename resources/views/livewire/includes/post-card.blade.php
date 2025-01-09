<div class="bg-white rounded-xl shadow-sm h-64 flex flex-row w-full dark:bg-neutral-900">
    <div class="h-full w-6/12">
        <img class="size-full object-cover object-center rounded-xl overflow-hidden" src="{{ $post->imagePath }}" alt="{{$post->title}}" alt="Card Image">
    </div>
    <div class="h-full p-6 w-6/12 flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">{{$post->title}}</h3>
            <p class="mt-1 text-gray-500 dark:text-neutral-300">
                <span>{{$post->getExcerpt(50)}}</span>
            </p>
            <p class="text-xs mt-5 text-gray-500 dark:text-neutral-500">
                Tempo de leitura: <span class="font-bold">{{$post->getReadingTime()}} minutos</span>
            </p>
        </div>
        <a href="/posts/{{$post->slug}}" wire:navigate><button class="btn-small-blue">Ler mensagem</button></a>
    </div>
</div>