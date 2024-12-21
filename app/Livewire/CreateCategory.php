<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Str;
use App\Models\Category;

class CreateCategory extends Component
{
    public $categoryId;

    #[Rule('required|min:2|max:50')]
    public $name;

    #[Rule('required|min:2|max:50')]
    public $slug;

    #[Rule('required')]
    public $color;

    public function mount($name = null, $slug = null, $color = null, $categoryId = null){
        $this->name = $name;
        $this->slug = $slug;
        $this->color = $color;
        $this->categoryId = $categoryId;
    }


    public function submit(){
        $validated = $this->validate();

        if($this->categoryId){
            $category = Category::findOrFail($this->categoryId);
            $category->update($validated);
        }else{
            Category::create($validated);
        }

        return redirect('/categories');
    }
    public function generateSlug(){
        $this->slug = Str::slug($this->name);
    }

    public function render()
    {
        return view('livewire.create-category');
    }
}
