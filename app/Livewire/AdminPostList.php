<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use Livewire\Attributes\Url;

class AdminPostList extends Component
{
    use WithPagination;
    #[Url()]
    public $search = '';

    public function mount(){
        $this->search = '';
    }

    public function updatedSearch(){
        $this->resetPage(); 
    }

    public function render()
    {
        $posts = Post::where('title','like',"%{$this->search}%")->paginate(5);
        return view('livewire.admin-post-list',['posts'=>$posts]);
    }
}
