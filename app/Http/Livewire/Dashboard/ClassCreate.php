<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Classes;
use App\Models\ClassLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ClassCreate extends Component {
  public Classes $class;

  public $color = 'pink';

  private $colorOptions = ['pink', 'orange', 'lemon', 'mint', 'blue', 'teal', 'purple', 'lav', 'beige'];

  public array $errorMessages = [];

  public array $links = [];

  public function rules() {
    return [
      'class.name' => 'required',
      'class.teacher' => 'required',
      'class.teacher_email' => 'nullable',
      'class.video_link' => 'nullable|url',
      'class.class_location' => 'nullable',
      'class.period' => ['nullable'/*, new UniquePeriod()*/],
    ];
  }

  public function mount() {
    $this->class = new Classes();
  }

  public function create() {
    $this->validate();

    $class = $this->class;
    $class->userid = Auth::User()->id;
    $class->teacher = Crypt::encryptString($class->teacher);
    if (isset($class->teacher_email)) $class->teacher_email = Crypt::encryptString($class->teacher_email);
    if ($class->video_link == '') $class->video_link = null;
    if (isset($class->video_link)) $class->video_link = Crypt::encryptString($class->video_link);
    if (isset($class->class_location)) $class->class_location = Crypt::encryptString($class->class_location);
    if ($class->period == '') $class->period = null;
    $class->color = $this->color;

    foreach ($this->links as $link) {
      $newLink = new ClassLink;
      $newLink->class_id = $class->id;
      $newLink->name = $link['name'];
      $newLink->link = Crypt::encryptString($link['url']);
      $newLink->save();
    }

    $class->save();
    $this->emit('refreshClasses');
    $this->dispatchBrowserEvent('close-adddialog');
    $this->emit('toastMessage', 'Class successfully saved');
    $this->emit('updateClassData', $class->id);
    $this->class = new Classes();
  }

  public function removeLink($index) {
    unset($this->links[$index - 1]);
  }

  public function setColor($color) {
    $this->color = $color;
  }

  public function setLink($index, $name, $url) {
    $index--;
    $validator = Validator::make(
      ['links_' . $index . '_name' => $name, 'links_' . $index . '_url' => $url],
      [
        'links_' . $index . '_name' => 'required',
        'links_' . $index . '_url' => 'required|url',
      ],
      [
        'required' => 'Required',
        'url' => 'This URL is invalid',
      ]
    )->validate();
    $this->links[$index] = array('name' => $name, 'url' => $url);
  }

  /**
   * Validate updated properties
   * @param  mixed $propertyName
   * @return void
   */
  public function updated($propertyName) {
    $this->validateOnly($propertyName);
  }

  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();

    return view('livewire.dashboard.class-create')->with('colorOptions', $this->colorOptions);
  }
}
