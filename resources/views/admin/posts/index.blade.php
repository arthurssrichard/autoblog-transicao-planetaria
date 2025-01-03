@extends('layouts.main')
@section('title','Posts')
@section('content')
<main class="w-full flex flex-row justify-center p-5">
    
    <div class="w-10/12">
        <h2 class="mb-5 text-3xl font-bold dark:text-neutral-300">Postagens</h2>
        <livewire:admin-post-list/>
    </div>
</main>
@livewireStyles
@livewireScripts
@endsection