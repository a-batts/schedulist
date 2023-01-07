<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class DashboardCard extends Component
{
    public $backgroundColor;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($backgroundColor, $title)
    {
        $this->backgroundColor = $backgroundColor;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ui.dashboard-card');
    }
}
