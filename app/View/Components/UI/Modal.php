<?php

namespace App\View\Components\UI;

use Illuminate\View\Component;

class Modal extends Component
{
    public $alpine;
    public $submit;
    public $title;
    public $action;
    public $classes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($alpine, $submit = null, $title, $action, $classes)
    {
        $this->alpine = $alpine;
        $this->submit = $submit;
        $this->title = $title;
        $this->action = $action;
        $this->classes = $classes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.modal');
    }
}
