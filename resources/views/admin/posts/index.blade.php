@extends('layouts.main')
@section('title','Posts')
@section('content')
<h2>Postagens</h2>
<main class="w-full flex flex-row justify-center">
    <div class="w-10/12"><livewire:admin-post-list/></div>
</main>
@livewireStyles
@livewireScripts
@endsection