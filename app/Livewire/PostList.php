<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Category;
use Livewire\Attributes\Url;

class PostList extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $category = '';

    public function updatedSearch(){
        $this->resetPage(); 
    }

    public function teste(){
        dd("teste");
    }
    public function render()
    {
        $posts = Post::orderBy('published_at',$this->sort)
        ->when(Category::where('slug',$this->category)->first(), function($query){
            $query->categorySlug($this->category);
        })
                    ->where('title','like',"%{$this->search}%")
                    ->paginate(3);
        $categories = Category::all();
        return view('livewire.post-list',['posts'=>$posts, 'categories' => $categories]);
    }
}
