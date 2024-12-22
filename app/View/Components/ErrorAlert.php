<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ErrorAlert extends Component
{
    public $title;
    public $message;
    /**
     * Create a new component instance.
     */
    public function __construct($title = "Erro", $message = "Houve algum erro ao realizar essa ação")
    {
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.error-alert');
    }
}
