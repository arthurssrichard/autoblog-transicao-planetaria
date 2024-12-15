@extends('layouts.main')
@section('title','Novo post')
@section('content')
<main>
    <img src="{{str_starts_with($post->image, 'https://images.pexels.com') ? $post->image : asset('storage/'.$post->image)}}" alt="{{$post->title}}">
    <h2>{{$post->title}}</h2>
    <div id="post-body">{!!$post->body!!}</div>
    <audio autoplay controls id="audioPlayer">
        <source src="{{asset('storage/'.$post->audio)}}">
    </audio>
    <button id="ttsBtn"><ion-icon name="play-outline"></ion-icon></button>
</main>
@endsection