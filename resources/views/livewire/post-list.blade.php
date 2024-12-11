<div>
    <div>
        <h2>Search</h2>
        <input type="text">
    </div>
    <ul>
        @foreach($posts as $post)
        @include('livewire/includes/post-card')
        @endforeach
    </ul>
    <div class="my-3">
        {{$posts->links()}}
    </div>
</div>
