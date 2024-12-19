<div class="bg-white border rounded-xl shadow-sm h-64 flex flex-row">
    <div class="h-full w-6/12">
        <img class="size-full object-cover object-center rounded-xl overflow-hidden" src="https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80" alt="Card Image">
    </div>
    <div class="h-full p-6 w-6/12 flex flex-col justify-between">
        <div>
            <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">{{$post->title}}</h3>
            <p class="mt-1 text-gray-500 dark:text-neutral-400">{{$post->getExcerpt(100)}}</p>
            <p class="text-xs mt-5 text-gray-500 dark:text-neutral-500">Tempo de leitura: <span class="font-bold">{{$post->getReadingTime()}} minutos</span></p>
        </div>
        <a href="/posts/{{$post->slug}}"><button class="btn-small-blue">Ler mensagem</button></a>
    </div>
</div>