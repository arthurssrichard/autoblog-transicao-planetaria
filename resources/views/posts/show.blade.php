@extends('layouts.main')
@section('title','Novo post')
@section('content')
<main>
    <section 
        style="background-image: url('{{ $post->imagePath }}');" 
        aria-label="{{ $post->title }}"
        class="grid lg:grid-cols-2 gap-4 sm:gap-6 bg-center bg-no-repeat bg-cover backdrop-blur-md">

        <div class="p-4 md:p-5 min-h-96 flex flex-row z-10 justify-center">
            <img src="{{str_starts_with($post->image, 'https://images.pexels.com') ? $post->image : asset('storage/'.$post->image)}}" alt="{{$post->title}}"
            class="rounded-lg w-[500px]">
        </div>

        <div class="p-4 md:p-5 min-h-96 flex flex-col z-10 justify-center text-left w-10/12">
            <h2 class="text-5xl px-4 font-medium text-gray-800 dark:text-neutral-200 font-sans">{{$post->title}}</h2>
            <div class="p-5">
                <button class="btn-small-play" id="ttsBtn">Reproduzir <ion-icon name="play-outline" class="text-lg"></ion-icon></button>
            </div>
            <audio controls id="audioPlayer" class="hidden">
                <source src="{{asset('storage/'.$post->audio)}}">
            </audio>
        </div>

        <div class="absolute inset-0 bg-black/50 backdrop-blur-md"></div>
    </section>
    <section class="flex flex-row justify-center">
        <div class="w-6/12 p-5 text-lg font-normal" id="post-body">{!!$post->body!!}</div>
    </section>



</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const playButton = document.getElementById('ttsBtn');
    const audioPlayer = document.getElementById('audioPlayer');

    playButton.addEventListener('click', function () {
        if (audioPlayer.paused) {
            audioPlayer.play();
            playButton.innerHTML = 'Pausar <ion-icon name="pause-outline" class="text-lg"></ion-icon>';
        } else {
            audioPlayer.pause();
            playButton.innerHTML = 'Reproduzir <ion-icon name="play-outline" class="text-lg"></ion-icon>';
        }
    });
});

</script>
@endsection