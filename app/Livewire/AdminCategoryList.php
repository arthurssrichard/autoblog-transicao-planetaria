<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Post;
use Livewire\WithPagination;
use Livewire\Attributes\Url;


class AdminCategoryList extends Component
{
    use WithPagination;

    #[Url()]
    public $search = '';

    public $selectedId;

    public function mount()
    {
        $this->search = '';
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function setDelete($id)
    {
        $this->selectedId = $id;
    }

    public function delete()
    {
        $category = Category::findOrFail($this->selectedId);
        if ($category->name == "Sem categoria" || $category->id === 1) {
            session()->flash('error', 'A categoria "Sem categoria" não pode ser deletada.');
        } else {
            Post::where('category_id', $category->id)->update(['category_id' => 1]);
            $category->delete();
        }
        $this->reset('selectedId');
        $this->dispatch('close-modal');
    }


    public function render()
    {
        $categories = Category::where('name', 'like', "%{$this->search}%")->paginate(5);
        return view('livewire.admin-category-list', ["categories" => $categories]);
    }
}
