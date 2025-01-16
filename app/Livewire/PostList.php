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

    #[Url(as: 'pesquisa', history: true)]
    public $search = '';

    #[Url(as: 'ordem', history: true)]
    public $sort = 'desc';

    #[Url(as: 'categoria', history: true)]
    public $category = null;

    #[Url(as: 'destacados', history: true)]
    public $featured;

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
                    ->when($this->featured, function ($query){
                        return $query->where('featured',true);
                    })
                    ->where('title','like',"%{$this->search}%")
                    ->paginate(8);
        $categories = Category::all();
        return view('livewire.post-list',['posts'=>$posts, 'categories' => $categories]);
    }
}
