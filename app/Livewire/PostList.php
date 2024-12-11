<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class PostList extends Component
{
    use WithPagination;
    public function render()
    {
        $posts = Post::orderBy('published_at', 'desc')->paginate(3);
        return view('livewire.post-list',['posts'=>$posts]);
    }
}
