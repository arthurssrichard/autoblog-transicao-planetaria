<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

use function Laravel\Prompts\alert;

class AdminCategoryList extends Component
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

    public function delete($categoryId){
        $category = Category::findOrFail($categoryId);
        if($category->name == "Sem categoria" || $category->id === 1){
            session()->flash('error', 'A categoria "Sem categoria" não pode ser deletada.');
            return;
        }
        $category->delete();
    }


    public function render()
    {
        $categories = Category::where('name','like',"%{$this->search}%")->paginate(5);
        return view('livewire.admin-category-list', ["categories"=>$categories]);
    }
}
