<?php

namespace App\View\Components\ui;

use Illuminate\View\Component;

class TimePicker extends Component
{
    public string $title;

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
        return view('components.ui.time-picker');
    }
}
