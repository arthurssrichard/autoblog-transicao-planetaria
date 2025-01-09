@extends('layouts.admin')
@section('title','Categories')
@section('content')
<main class="w-full flex flex-row justify-center p-5">
    <div class="w-8/12">
        <div class="mb-5 flex justify-between">
            <h2 class="text-3xl font-bold dark:text-neutral-300">Categorias</h2>
            <a href="/blogadmin/categories/create" wire:navigate><button class="btn-small-blue">Nova categoria</button></a>
        </div>
        <livewire:admin-category-list/>
    </div>
</main>
@livewireStyles
@livewireScripts
@endsection