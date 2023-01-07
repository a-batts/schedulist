<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * The modal title
     *
     * @var string
     */
    public string $title;

    /**
     * The Alpine variable to bind to
     *
     * @var string
     */
    public string $bind;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title, string $bind)
    {
        $this->title = $title;
        $this->bind = $bind;
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
