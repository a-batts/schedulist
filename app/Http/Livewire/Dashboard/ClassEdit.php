<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Classes;
use App\Models\ClassLink;

use App\Rules\UniquePeriod;

use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

use Livewire\Component;

class ClassEdit extends Component {
  public $classData;

  public $color;

  private $colorOptions = ['pink', 'orange', 'lemon', 'mint', 'blue', 'teal', 'purple', 'lav', 'beige'];

  public array $errorMessages = [];

  public array $links = [];

  public Classes $selClass;

  protected $listeners = ['selectClass', 'updateClassData'];

  public function rules() {
    return [
      'selClass.name' => 'required',
      'selClass.teacher' => 'required',
      'selClass.teacher_email' => 'nullable',
      'selClass.video_link' => 'nullable|url',
      'selClass.class_location' => 'nullable',
      'selClass.period' => ['nullable'/*, new UniquePeriod()*/],
    ];
  }

  public function mount() {
    $classes = Auth::User()->classes()->with('links')->get();
    $classData = [];
    foreach ($classes as $class) {
      $class->teacher = Crypt::decryptString($class->teacher);
      if (isset($class->teacher_email)) $class->teacher_email = Crypt::decryptString($class->teacher_email);
      if (isset($class->video_link)) $class->video_link = Crypt::decryptString($class->video_link);
      if (isset($class->class_location)) $class->class_location = Crypt::decryptString($class->class_location);
      foreach ($class->links as $link) {
        $link->link = Crypt::decryptString($link->link);
      }
      $classData[$class->id] = $class->toArray();
    }
    $this->classData = $classData;
    $this->selClass = new Classes();
  }

  public function edit() {
    $this->validate();

    $selClass = $this->selClass;
    $selClass->teacher = Crypt::encryptString($selClass->teacher);
    if (isset($selClass->teacher_email)) $selClass->teacher_email = Crypt::encryptString($selClass->teacher_email);
    if ($selClass->video_link == '') $selClass->video_link = null;
    if (isset($selClass->video_link)) $selClass->video_link = Crypt::encryptString($selClass->video_link);
    if (isset($selClass->class_location)) $selClass->class_location = Crypt::encryptString($selClass->class_location);
    if ($selClass->period == '') $selClass->period = null;
    $selClass->color = $this->color;

    ClassLink::where('class_id', $selClass->id)->delete();

    foreach ($this->links as $link) {
      $newLink = new ClassLink;
      $newLink->class_id = $selClass->id;
      $newLink->name = $link['name'];
      $newLink->link = Crypt::encryptString($link['url']);
      $newLink->save();
    }

    $selClass->save();
    $this->emit('refreshClasses');
    $this->dispatchBrowserEvent('close-dialog');
    $this->emit('toastMessage', 'Class successfully edited');

    $this->updateClassData($selClass->id);
  }

  public function removeLink($index) {
    unset($this->links[$index - 1]);
  }

  public function selectClass($id) {
    $selClass = Classes::where(['id' => $id, 'userid' => Auth::User()->id])->with('links')->first();
    $selClass->teacher = Crypt::decryptString($selClass->teacher);
    if (isset($selClass->teacher_email)) $selClass->teacher_email = Crypt::decryptString($selClass->teacher_email);
    if (isset($selClass->video_link)) $selClass->video_link = Crypt::decryptString($selClass->video_link);
    if (isset($selClass->class_location)) $selClass->class_location = Crypt::decryptString($selClass->class_location);
    $this->links = [];
    foreach ($selClass->links as $link) {
      array_push($this->links, array('name' => $link->name, 'url' => Crypt::decryptString($link->link)));
    }
    $this->color = $selClass->color;
    $this->selClass = $selClass;
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

  public function updateClassData($id) {
    $class = Classes::find($id);
    $class->teacher = Crypt::decryptString($class->teacher);
    if (isset($class->teacher_email)) $class->teacher_email = Crypt::decryptString($class->teacher_email);
    if (isset($class->video_link)) $class->video_link = Crypt::decryptString($class->video_link);
    if (isset($class->class_location)) $class->class_location = Crypt::decryptString($class->class_location);
    foreach ($class->links as $link) {
      $link->link = Crypt::decryptString($link->link);
    }
    $this->classData[$class->id] = $class->toArray();
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

    return view('livewire.dashboard.class-edit')->with('colorOptions', $this->colorOptions);
  }
}
