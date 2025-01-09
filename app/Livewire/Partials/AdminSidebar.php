<?php

namespace App\Livewire\Partials;

use Livewire\Component;

class AdminSidebar extends Component
{
    public function isActive($routeName){
        return request()->is("$routeName*") ? 'bg-gray-300 dark:bg-gray-900 rounded-xl text-yellow-700 dark:text-yellow-500' : '';
    }

    public function render()
    {
        return view('livewire.partials.admin-sidebar');
    }
}
