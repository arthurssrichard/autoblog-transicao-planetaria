@extends('layouts.admin')
@section('title', 'Novo livro')
@section('content')
<main class="w-full px-10 py-16">
    <h2 class="mb-5 text-3xl font-bold dark:text-neutral-300">Novo Livro</h2>
    <form action="/blogadmin/books" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Título do Livro -->
        <div class="p-6 bg-white shadow-md rounded-lg mb-10 dark:bg-neutral-800">
            <div>
                <label for="title" class="block text-sm font-medium mb-2 dark:text-white">Título</label>
                <input type="text" name="title" id="title" class="text-input-default" placeholder="Digite o título do livro">
            </div>
        </div>

        <!-- Início e fim do capítulo -->
        <div class="p-6 bg-white shadow-md rounded-lg mb-10 dark:bg-neutral-800">
            <h3 class="text-2xl font-bold mb-2 dark:text-neutral-300">Início e fim do capítulo</h3>
            <small class="text-gray-400 dark:text-neutral-500 block mb-4">(Termos demarcantes)</small>
            <div class="grid lg:grid-cols-2 lg:gap-6 sm:gap-4">
                <div>
                    <label for="inicio-indice" class="block text-sm font-medium mb-2 dark:text-white">Início</label>
                    <input type="text" name="inicio_indice" id="inicio-indice" class="text-input-default" placeholder="Digite o início do índice">
                </div>
                <div>
                    <label for="fim-indice" class="block text-sm font-medium mb-2 dark:text-white">Fim</label>
                    <input type="text" name="fim_indice" id="fim-indice" class="text-input-default" placeholder="Digite o fim do índice">
                </div>
            </div>
        </div>

        <!-- Páginas do índice -->
        <div class="p-6 bg-white shadow-md rounded-lg mb-10 dark:bg-neutral-800">
            <h3 class="text-2xl font-bold mb-2 dark:text-neutral-300">Páginas do índice de mensagens</h3>
            <div class="grid lg:grid-cols-2 lg:gap-6 sm:gap-4">
                <div>
                    <label for="pg-inicio" class="block text-sm font-medium mb-2 dark:text-white">Primeira</label>
                    <input type="number" step="1" min="1" name="pg_inicio" id="pg-inicio" class="text-input-default" placeholder="Digite o número da primeira página">
                </div>
                <div>
                    <label for="pg-fim" class="block text-sm font-medium mb-2 dark:text-white">Última</label>
                    <input type="number" step="1" min="1" name="pg_fim" id="pg-fim" class="text-input-default" placeholder="Digite o número da última página">
                </div>
            </div>
        </div>

        <!-- Upload do Arquivo -->
        <div class="p-6 bg-white shadow-md rounded-lg mb-10 dark:bg-neutral-800">
        <h3 class="text-2xl font-bold mb-2  dark:text-neutral-300">Arquivo do livro</h3>
        <label for="book" class="sr-only">Choose file</label>
        <input type="file" name="book" id="book" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
            file:bg-gray-50 file:border-0
            file:me-4
            file:py-3 file:px-4
            dark:file:bg-neutral-700 dark:file:text-neutral-400">
        </div>

        <!-- Botão de Enviar -->
        <div>
            <button class="btn-small bg-blue-600 text-white hover:bg-blue-700 focus:bg-blue-700" type="submit">
                Adicionar
            </button>
        </div>
    </form>
</main>
@endsection
