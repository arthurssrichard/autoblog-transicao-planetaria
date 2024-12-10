@extends('layouts.main')
@section('title','Novo post')
@section('content')
<main>
    <h2>{{$post->title}}</h2>
    <div>
        {!!$post->body!!}
    </div>
</main>
@endsection