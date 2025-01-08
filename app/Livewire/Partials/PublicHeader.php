<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class PublicHeader extends Component
{
    public function isActive($routeName){
        
        return request()->is($routeName) ? 'text-teal-500' : 'text-gray-400';
    }


    public function render()
    {
        return view('livewire.partials.public-header');
    }
}
