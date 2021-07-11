<?php

namespace App\View\Components\UI;

use Illuminate\View\Component;

class ValidationHint extends Component
{
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($message, $for)
    {
        if(isset($message[$for]))
          $this->message = $message[$for][0];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.validation-hint');
    }
}
