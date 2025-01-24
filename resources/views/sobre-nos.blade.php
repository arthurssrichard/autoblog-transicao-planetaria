@extends('layouts.main')
@section('title','Sobre nós')
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
            <h1 class="text-4xl font-bold text-neutral-700 dark:text-neutral-200">Sobre nós</h1>
            <p class="text-neutral-700 dark:text-neutral-300">Temos o objetivo de aumentar o número de pessoas informadas sobre Transição Planetária tendo como única fonte as que são recebidas e organizadas no Centro Espírita Servos de Jesus – Vitória / ES, todas extraídas do site da instituição (www.extraseintras.com.br).</p>
        </div>
    </section>
</main>
@endsection
