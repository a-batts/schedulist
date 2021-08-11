<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthCard extends Component
{
    public $description;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $description = null){
       $this->title = $title;
       $this->description = $description ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(){
        return view('components.ui.auth-card');
    }
}
