<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Str;
use App\Models\Category;

class CreateCategory extends Component
{
    #[Rule('required|min:2|max:50')]
    public $name;

    #[Rule('required|min:2|max:50')]
    public $slug;

    #[Rule('required')]
    public $color;

    public function store(){
        $validated = $this->validate();
        Category::create($validated);
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
