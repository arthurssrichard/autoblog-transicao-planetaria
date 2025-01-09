@extends('layouts.admin')
@section('title','Posts')
@section('content')
<section class="w-full flex flex-row justify-center p-5">
    <div class="w-10/12">
    <div class="mb-5 flex justify-between">
            <h2 class="text-3xl font-bold dark:text-neutral-300">Postagens</h2>
            <a href="/blogadmin/posts/create" wire:navigate><button class="btn-small-blue">Nova postagem</button></a>
        </div>
        <livewire:admin-post-list/>
    </div>
</section>
@livewireStyles
@livewireScripts
@endsection