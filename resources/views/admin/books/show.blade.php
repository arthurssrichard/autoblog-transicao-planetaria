@extends('layouts.admin')
@section('title', 'Capítulos do Livro')
@section('content')
<main class="w-full px-10 py-16">
    <!-- Header -->
    <div class="mb-10">
        <h2 class="text-3xl font-bold text-yellow-900 dark:text-neutral-300">Capítulos do Livro</h2>
        <p class="text-gray-500 dark:text-neutral-400">Selecione um capítulo para gerar uma postagem automaticamente.</p>
    </div>
    <button x-data x-on:click="$dispatch('open-modal')" class="btn-small-blue mb-2">Auto-gerar capítulo especifico</button>
    <x-specific-auto-create bookId="{{$book->id}}"></x-specific-auto-create>
    <!-- Tabela de Capítulos -->
    <div class="bg-white shadow-md rounded-lg dark:bg-neutral-800 overflow-hidden w-full sm:w-8/12">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-100 dark:bg-neutral-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-neutral-400">
                        Nome do Capítulo
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-neutral-400">
                        Ação
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
                @foreach($capitulos as $capitulo)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-neutral-300">
                        {{ $capitulo }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-neutral-300">
                        <form action="/blogadmin/posts/auto-create" method="POST" class="inline-block">
                            @csrf
                            <input type="hidden" name="title" value="{{ $capitulo }}">
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" title="Gerar mensagem a partir do livro"
                                class="text-blue-600 hover:text-blue-800 focus:outline-none focus:ring focus:ring-blue-300">
                                <ion-icon name="book" class="text-xl"></ion-icon>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
