<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmActionModal extends Component
{
    public $deleteParagraph;
    public $message;

    /**
     * Create a new component instance.
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirm-action-modal');
    }
}
