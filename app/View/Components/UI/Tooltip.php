<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Tooltip extends Component {
    public $id;
    public $text;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tooltipId, $text) {
        $this->id = $tooltipId;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render() {
        return view('components.ui.tooltip');
    }
}
