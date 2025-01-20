<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SuccessAlert extends Component
{
    public $title;
    public $message;

    public function __construct($title = "Erro", $message = "Sucesso!")
    {
        $this->title = $title;
        $this->message = $message;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alerts.success-alert');
    }
}
