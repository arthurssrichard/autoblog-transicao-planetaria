@extends('layouts.main')
@section('title','Novo post')
@section('content')
<main class="container mx-auto px-5 flex flex-grow">
    <div class="mb-10">
        <h2 class="mt-16 mb-5 text-3xl text-yellow-900 font-bold">Novo livro</h2>
        <form action="/books" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title">Título</label>
                <input type="text" name="title" id="title" class="bg-gray-50 border">
            </div>

            <div class="py-4 flex flex-row flex-wrap">
            <h2 class="mt-16 mb-5 text-2xl text-yellow-900 font-bold w-full">Inicio e fim do capítulo</h2>
            <small class="w-full text-gray-400">(Termos demarcantes)</small>
                <div>
                    <label for="inicio-indice">Início</label>
                    <input type="text" name="inicio_indice" id="inicio-indice" class="bg-gray-50 border">
                </div>
                <div>
                    <label for="fim-indice">Fim</label>
                    <input type="text" name="fim_indice" id="fim-indice" class="bg-gray-50 border">
                </div>
            </div>

            <div class="py-4 flex flex-row flex-wrap">
                <h2 class="mt-16 mb-5 text-2xl text-yellow-900 font-bold w-full">Páginas do índice de mensagens</h2>
                <div>
                    <label for="pg-inicio">Primeira</label>
                    <input type="number" step="1" min="1" name="pg_inicio" id="pg-inicio" class="bg-gray-50 border">
                </div>
                <div>
                    <label for="pg-fim">Última</label>
                    <input type="number" step="1" min="1" name="pg_fim" id="pg-fim" class="bg-gray-50 border">
                </div>
            </div>

            <div class="py-4">
                <label for="book">Arquivo</label>
                <input type="file" name="book" id="book" class="bg gray-50 border">
            </div>

            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2" type="submit">Adicionar</button>
        </form>
    </div>

</main>
@endsection