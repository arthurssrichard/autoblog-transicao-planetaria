@extends('layouts.main')
@section('title', 'Livros salvos')
@section('content')
<main class="w-full px-10 py-16">
    <section class="mb-10">
        <h2 class="mb-5 text-3xl font-bold dark:text-neutral-300">Livros salvos</h2>
        <div class="w-full mb-5">
            <div class="grid grid-cols-5 gap-10 gap-y-32 w-full">
                @foreach($books as $book)
                <a href="/blogadmin/books/{{$book->id}}">
                        <div class="bg-teal-600 hover:bg-teal-700 duration-150 p-5 py-16 w-full rounded-xl h-64 flex flex-col justify-center">
                        <span class="text-xl font-bold dark:text-neutral-300">
                            {{$book->nome}}
                        </span>
                    </div>
                </a>
                @endforeach

                <a href="/blogadmin/books/create">
                        <div class="bg-neutral-600 hover:bg-neutral-700 p-5 py-16 w-full rounded-xl h-64 flex flex-col justify-center items-center border-2 border-dashed duration-150">
                            
                        <ion-icon class="dark:text-neutral-300 text-4xl" name="add-circle"></ion-icon>
                        <span class="text-xl font-bold dark:text-neutral-300">
                            Adicionar novo
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </section>
</main>
@endsection
