<?php

namespace App\Http\Livewire\Assignments;

use App\Classes\LinkPreview;

use App\Models\Assignment;
use App\Models\Classes;

use Carbon\Carbon;
use Carbon\Exceptions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Livewire\Component;

class AssignmentEdit extends Component {
  public Assignment $assignment;

  public array $classes = [['id' => -1, 'name' => 'No Class']];

  public array $errorMessages = [];

  protected $preview;

  protected $messages = [
    'url' => 'Make sure the link is a valid URL',
  ];

  protected $rules = [
    'assignment.assignment_name' => 'required',
    'assignment.classid' => 'nullable',
    'assignment.due' => 'required',
    'assignment.assignment_link' => 'url|nullable',
    'assignment.description' => 'required',
    'assignment.status' => 'required',
    'assignment.userid' => 'required',
  ];

  protected $listeners = ['refreshEditModal' => '$refresh', 'setTime', 'setDate'];

  /**
   * Mount component
   * @return void
   */
  public function mount() {
    $classes = Classes::where('userid', Auth::User()->id)->get();
    foreach ($classes as $class) {
      array_push($this->classes, ['id' => $class->id, 'name' => $class->name]);
    }

    if (isset($this->assignment->assignment_link))
      $this->assignment->assignment_link = Crypt::decryptString($this->assignment->assignment_link);
    $this->assignment->assignment_name = Crypt::decryptString($this->assignment->assignment_name);
    $this->assignment->description = Crypt::decryptString($this->assignment->description);
    $this->time = Carbon::parse($this->assignment->due)->format('G:i');
    $this->date = Carbon::parse($this->assignment->due)->format('Y-m-d');
  }

  /**
   * Save updated assignment
   * @return void
   */
  public function edit() {
    $this->validate();

    $assignment = $this->assignment;
    if ($assignment->assignment_link == null) {
      $assignment->link_image = null;
      $assignment->link_description = null;
    } else {
      $this->preview = LinkPreview::create($assignment->assignment_link)->updatePreview($assignment->assignment_link);
      $assignment->assignment_link = Crypt::encryptString($assignment->assignment_link);
      $assignment->link_image = $this->preview->getPreview();
      $assignment->link_description = $this->preview->getText();
    }
    $assignment->assignment_name = Crypt::encryptString($assignment->assignment_name);
    $assignment->description = Crypt::encryptString($assignment->description);
    $assignment->due = Carbon::parse($assignment->due);

    $assignment->save();

    $this->dispatchBrowserEvent('hide-edit-menu');
    $this->emit('toastMessage', 'Changes successfully saved');

    $assignment->assignment_link = Crypt::decryptString($assignment->assignment_link);
    $assignment->assignment_name = Crypt::decryptString($assignment->assignment_name);
    $assignment->description = Crypt::decryptString($assignment->description);

    $this->emit('refreshAssignmentPage');
  }

  /**
   * Delete assignment
   * @return void
   */
  public function delete() {
    $this->assignment->delete();
    $this->redirect('assignments');
    $this->emit('toastMessage', 'Assignment was deleted');
  }

  /**
   * Validates updated properties
   * @param  mixed $propertyName
   * @return void
   */
  public function updated($propertyName) {
    $this->validateOnly($propertyName);
  }

  public function setClass($val) {
    if (Classes::where('id', $val)->where('userid', Auth::User()->id)->exists() || $val == -1)
      $this->assignment->classid = $val;
  }

  public function getDate() {
    return Carbon::parse($this->assignment->due)->toDateString();
  }

  public function setDate($val) {
    $date = explode('-', $val);
    try {
      $this->assignment->due = Carbon::parse($this->assignment->due)->setDate($date[0], $date[1], $date[2])->toString();
    } catch (Exceptions\InvalidFormatException $e) {
      $this->addError('assignment.due', 'Invalid date inputted');
    }
  }

  public function getTime() {
    return Carbon::parse($this->assignment->due)->format('H:i');
  }

  public function setTime($val) {
    $time = explode(':', $val);
    try {
      $this->assignment->due = Carbon::parse($this->assignment->due)->setTime($time[0], $time[1])->toString();
    } catch (Exceptions\InvalidFormatException $e) {
      $this->addError('assignment.due', 'Invalid time inputted');
    }
  }



  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();
    if ($this->assignment->assignment_link != null) {
      if (!$this->errorBag->has('assignment.link'))
        $this->preview = LinkPreview::create($this->assignment->assignment_link)->updatePreview($this->assignment->assignment_link);
      else
        $this->preview = LinkPreview::create($this->assignment->assignment_link)->withError();
    }
    $this->emit('setTime', Carbon::parse($this->assignment->due)->format('G:i'));
    $this->emit('setDate', Carbon::parse($this->assignment->due)->format('Y-m-d'));

    return view('livewire.assignments.assignment-edit')->with('preview', $this->preview);
  }
}
