<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LinkPreview extends Component
{
    public $preview;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($preview)
    {
        $this->preview = $preview;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.link-preview');
    }
}
