@extends('layouts.main')
@section('title','Novo post')
@section('content')
<main class="container mx-auto px-5 flex flex-grow">
  <livewire:create-post :title="$title" :slug="$slug" :mensagem="$mensagem"/>
</main>
@livewireScripts
<script src="https://cdn.tiny.cloud/1/{{env('TINYMCE_API_KEY')}}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
@endsection