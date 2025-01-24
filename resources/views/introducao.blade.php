@extends('layouts.main')
@section('title','Introdução')
@section('metatags')
<meta name="description" content="Descubra sobre nosso propósito de compartilhar mensagens espíritas">
<meta name="robots" content="index, follow">
<meta property="og:title" content="Mensagens Espíritas - Transição planetária em andamento">
<meta property="og:description" content="Descubra sobre nosso propósito de compartilhar mensagens espíritas">
<meta property="og:image" content="{{url('/optimized-image/logo.png')}}">
@endsection
@section('content')
<main class="flex-grow flex flex-col">
    <section class="px-4 py-6 flex flex-col justify-center items-center h-full">
        <div class="w-10/12 sm:w-6/12 space-y-2">
            <h1 class="text-4xl font-bold text-neutral-700 dark:text-neutral-200">Introdução</h1>
            <p class="text-neutral-700 dark:text-neutral-300">
                Aqui você vai encontrar todas as informações sobre Transição Planetária, o que este processo tanto impacta na humanidade, reforma íntima, encarnação chave, oportunidade de melhoria e principalmente instrumentos para direcionar sua mente e suas atitudes voltadas ao próximo.
            </p>
            <p class="text-neutral-700 dark:text-neutral-300">Sem Caridade não há Salvação. Paz e Luz !</p>
        </div>
    </section>
</main>
@endsection
