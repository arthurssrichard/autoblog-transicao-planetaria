@extends('layouts.admin')
@section('title','Novo post')
@section('content')
<main>
    <livewire:create-category 
    :name="$category->name ?? null"  
    :slug="$category->slug ?? null"  
    :color="$category->color ?? null"  
    :category-id="$category->id ?? null" 
    />
</main>
@livewireScripts
@endsection