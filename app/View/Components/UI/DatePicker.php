<?php

namespace App\View\Components\ui;

use Illuminate\View\Component;

class DatePicker extends Component
{
    public string $title;

    public string $bind;

    public ?string $validDate;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $title,
        string $bind,
        ?string $validDate = null
    ) {
        $this->title = $title;

        $this->bind = $bind;

        $this->validDate = $validDate;
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
