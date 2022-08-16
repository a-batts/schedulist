<?php

namespace App\View\Components\Ui;

use Illuminate\View\Component;

class Select extends Component {

  /**
   * The select title
   *
   * @var string
   */
  public string $title;

  /**
   * The data to populate the select with
   *
   * @var string
   */
  public string $data;

  /**
   * The style to apply for the select component (accepts either outlined or filled)
   *
   * @var string
   */
  public string $style;

  /**
   * The Alpine variable to bind to
   *
   * @var string
   */
  public string $bind;

  /**
   * The initial value for the select
   *
   * @var string|null
   */
  public ?string $value;

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
