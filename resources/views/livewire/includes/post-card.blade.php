<li>
    <a href="/posts/{{$post->slug}}">
        <h4>{{$post->title}}</h4>
        <p>{!!Illuminate\Support\Str::limit($post->body,30)!!}</p>
    </a>
</li>