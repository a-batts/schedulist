<?php

namespace App\View\Components;

use App\Classes\LinkPreview as Preview;
use Illuminate\View\Component;

class LinkPreview extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Preview $preview)
    {
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
