@extends('layouts.main')
@section('title','Novo post')
@section('content')
<main class="dark:bg-neutral-900">
    <section 
        style="background-image: url('{{ $post->imagePath }}');" 
        aria-label="{{ $post->title }}"
        class="grid lg:grid-cols-2 lg:gap-4 sm:gap-0 bg-center bg-no-repeat bg-cover backdrop-blur-md">

        <div class="lg:min-h-96 sm:min-h-80 flex flex-col z-10 justify-center items-center text-left w-full">
            <div class="p-4 md:p-5 h-72 w-96 flex flex-row z-10 justify-center items-center">
                <img src="{{str_starts_with($post->image, 'https://images.pexels.com') ? $post->image : asset('storage/'.$post->image)}}" alt="{{$post->title}}"
                class="rounded-lg w-full h-full object-cover">
            </div>
        </div>

        <div class="lg:min-h-96 sm:min-h-60 flex flex-col z-10 justify-center text-left lg:w-10/12 sm:w-full">
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
        <div class="lg:w-6/12 md:w-full p-5 md:py-5 md:px-3 text-lg font-normal dark:text-neutral-200" id="post-body">{!!$post->body!!}</div>
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