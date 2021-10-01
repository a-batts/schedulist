<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Select extends Component {
  public array $data;
  public $text;
  public $type;
  public $var;
  public $alpine;
  public $default;

  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($text, $var = null, $alpine = null, $type, $data, $default = null) {
    $this->text = $text;
    $this->var = $var;
    $this->alpine = $alpine;
    $this->type = $type;
    if (is_array($data))
      $this->data = $data;
    else
      $this->data = explode(',', $data);
    $this->default = $default;
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
