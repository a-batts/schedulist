<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class ValidationError extends Component
{
    public $for;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($for)
    {
        $this->for = $for;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.validation-error');
    }
}
