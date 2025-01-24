@extends('layouts.main')
@section('title','Home')
@section('metatags')
<meta name="description" content="Bem vindo ao site Transição Planetária em Andamento!">
<meta name="robots" content="index, follow">
<meta property="og:title" content="Mensagens Espíritas - Transição planetária em andamento">
<meta property="og:description" content="Bem vindo ao site Transição Planetária em Andamento!">
<meta property="og:image" content="{{url('/optimized-image/logo.png')}}">
@endsection
@section('content')
<main class="container mx-auto px-5 flex flex-col">
    <section class="mb-10">
        <h2 class="mt-16 mb-5 text-3xl text-teal-500 font-bold">Posts destacados</h2>
        <div class="w-full mb-5">
            <div class="grid grid-cols-3 gap-10 gap-y-20 w-full">
                {{-- post card --}}
                @foreach($featuredPosts as $post)
                <div class="md:col-span-1 col-span-3">
                    <a href="/posts/{{$post->slug}}">
                        <div class="h-72 max-w-96 flex flex-row z-10 justify-center items-center">
                            <img class="rounded-lg w-full h-full object-cover" src="{{$post->image}}">
                        </div>
                    </a>
                    <div class="mt-3">
                        <div class="flex items-center mb-2">
                            <a href="/posts?category={{$post->category->slug}}" class="bg-teal-600 text-white rounded-xl px-3 py-1 text-xs mr-2">
                                <span>{{$post->category->name}}</span>
                            </a>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">{{$post->published_at->format('Y-m-d')}}</p>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-200">{{$post->title}}</h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mb-10">
        <h2 class="mt-16 mb-5 text-3xl text-teal-500 font-bold">Posts recentes</h2>
        <div class="w-full mb-5">
            <div class="grid grid-cols-3 gap-10 gap-y-32 w-full">
                {{-- post card --}}
                @foreach($posts as $post)
                <div class="md:col-span-1 col-span-3">
                    <a href="/posts/{{$post->slug}}">
                        <div class="h-72 max-w-96 flex flex-row z-10 justify-center items-center">
                            <img class="rounded-lg w-full h-full object-cover" src="{{$post->image}}">
                        </div>
                    </a>
                    <div class="mt-3">
                        <div class="flex items-center mb-2">
                            <a href="/posts?category={{$post->category->slug}}" class="bg-teal-600 text-white rounded-xl px-3 py-1 text-xs mr-2">
                                <span>{{$post->category->name}}</span>
                            </a>
                            <p class="text-gray-500 dark:text-gray-400 text-sm">{{$post->published_at->format('Y-m-d')}}</p>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-200">{{$post->title}}</h3>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="py-3 flex justify-center">
                <a href="/posts" wire:navigate><button class="btn-small-blue">LER MAIS</button></a>
            </div>
        </div>
    </section>
</main>

@endsection