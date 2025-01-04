@extends('layouts.main')
@section('title','Categories')
@section('content')
<main class="w-full flex flex-row justify-center p-5">
    <div class="w-8/12">
        <h2 class="mb-5 text-3xl font-bold dark:text-neutral-300">Categorias</h2>
        <livewire:admin-category-list/>
    </div>
</main>
@livewireStyles
@livewireScripts
@endsection