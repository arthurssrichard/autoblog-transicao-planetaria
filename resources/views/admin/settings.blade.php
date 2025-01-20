@extends('layouts.admin')
@section('title','Configurações')
@section('content')
<section class="p-5 flex flex-col justify-center">

<h2 class="text-3xl font-bold dark:text-neutral-300">Configurações</h2>
    <livewire:admin-settings-panel />
</section>
@endsection