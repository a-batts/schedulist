<?php

namespace App\View\Components\ui;

use Illuminate\View\Component;

class DatePicker extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $title,
        public string $bind,
        public ?string $validDate = null,
        public ?string $disabled = null
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.date-picker');
    }
}
