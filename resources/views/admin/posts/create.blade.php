@extends('layouts.admin')
@section('title','Novo post')
@section('content')
<main>
  <livewire:create-post :title="$title" :slug="$slug" :mensagem="$mensagem" :category_id="$category_id ?? null" :tags="$tags ?? null" :date="$date ?? null" :time="$time ?? null" :image="$imagePath ?? null" :post_id="$postId ?? null"/>
</main>
@livewireScripts
<script src="https://cdn.tiny.cloud/1/{{env('TINYMCE_API_KEY')}}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
@endsection