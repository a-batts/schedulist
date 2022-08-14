<?php

namespace App\View\Components\ui;

use Illuminate\View\Component;

class TimePicker extends Component {

    public string $id;

    public string $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $id, string $title) {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render() {
        return view('components.ui.time-picker');
    }
}
