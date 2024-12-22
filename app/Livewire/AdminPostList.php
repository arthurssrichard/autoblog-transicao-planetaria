<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Storage;

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

    public function delete($postId){

        $post = Post::findOrFail($postId);
        if($post->audio){
            Storage::disk('public')->delete($post->audio);
        }
        if($post->imageIsLocal()){
            Storage::disk('public')->delete($post->image);
        }
        
        $post->delete();
    }


    public function render()
    {
        $posts = Post::where('title','like',"%{$this->search}%")->paginate(5);
        return view('livewire.admin-post-list',['posts'=>$posts]);
    }
}
