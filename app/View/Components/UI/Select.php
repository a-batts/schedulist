<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Select extends Component {
  public $data;
  public $title;
  public $style;
  public $bind;
  public $value;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($title, $bind, $style, $data, $value = null) {
    $this->title = $title;
    $this->bind = $bind;
    $this->style = $style;
    $this->data = $data;
    $this->value = $value;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render() {
    return view('components.ui.select')->with('data', $this->data);
  }
}
