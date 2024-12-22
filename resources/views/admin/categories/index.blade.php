@extends('layouts.main')
@section('title','Categories')
@section('content')
<h2>Categorias</h2>
<main class="w-full flex flex-row justify-center">
    <div class="w-8/12"><livewire:admin-category-list/></div>
</main>
@livewireStyles
@livewireScripts
@endsection