<?php

namespace App\Http\Livewire\Assignments;

use App\Classes\LinkPreview;

use App\Models\Assignment;
use App\Models\Classes;

use Carbon\Carbon;
use Carbon\Exceptions;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use InvalidArgumentException;
use Livewire\Component;

class AssignmentEdit extends Component {
  /**
   * The assignment to edit
   *
   * @var Assignment
   */
  public Assignment $assignment;

  /**
   * Array of the users classes
   *
   * @var array
   */
  public array $classes = [['id' => -1, 'name' => 'No Class']];

  /**
   * The event due date and time
   *
   * @var Carbon
   */
  public Carbon $due;

  /**
   * Preview of the inputted link
   *
   * @var LinkPreview|null
   */
  protected ?LinkPreview $preview = null;

  /**
   * Custom error messages
   *
   * @var array
   */
  protected array $messages = [
    'url' => 'Make sure the link is a valid URL',
  ];

  /**
   * Validation rules
   *
   * @var array
   */
  protected array $rules = [
    'assignment.name' => 'required',
    'assignment.class_id' => 'nullable',
    'assignment.due' => 'required',
    'assignment.link' => 'url|nullable',
    'assignment.description' => 'required',
    'assignment.status' => 'required',
    'assignment.user_id' => 'required',
  ];

  protected $listeners = ['refreshEditModal' => '$refresh'];

  /**
   * Mount component
   * @return void
   */
  public function mount() {
    $this->due = Carbon::parse($this->assignment->due);

    $this->assignment->link = isset($this->assignment->link) ? Crypt::decryptString($this->assignment->link) : $this->assignment->link;

    $classes = Classes::where('user_id', Auth::User()->id)->get();
    foreach ($classes as $class)
      $this->classes[] = ['id' => $class->id, 'name' => $class->name];
  }

  /**
   * Save updated assignment
   * @return void
   */
  public function edit() {
    $this->validate();
    $assignment = $this->assignment;

    $this->dispatchBrowserEvent('hide-edit-menu');

    if ($assignment->link == null) {
      $assignment->link_image = null;
      $assignment->link_description = null;
    } else {
      $this->preview = LinkPreview::create($assignment->link)->updatePreview($assignment->link);
      $assignment->link = Crypt::encryptString($assignment->link);
      $assignment->link_image = $this->preview->getPreview();
      $assignment->link_description = $this->preview->getText();
    }

    $assignment->due = $this->due;

    $assignment->save();

    $this->emit('toastMessage', 'Changes successfully saved');

    $assignment->link = Crypt::decryptString($assignment->link);

    $this->emit('refreshAssignmentPage');
  }

  /**
   * Delete assignment
   * @return void
   */
  public function delete(): void {
    $this->assignment->delete();
    $this->redirect('assignments');
    $this->emit('toastMessage', 'Assignment was deleted');
  }

  /**
   * Set the assignment's class
   *
   * @param int $val
   * @return void
   */
  public function setClass(int $id): void {
    if (Classes::where('id', $id)->where('user_id', Auth::User()->id)->exists() || $id == -1)
      $this->assignment->class_id = $id;
  }

  /**
   * Get the assignment's due time
   *
   * @return string
   */
  public function getTime(): string {
    return $this->due->format('H:i');
  }

  /**
   * Set the assignment's due time
   *
   * @param array $time
   * @return void
   */
  public function setTime(array $time): void {
    $hours = $time['h'];
    $mins = $time['m'];

    if ($hours < 0 || $hours > 23 || $mins < 0 || $mins > 59) {
      $this->addError('due_time', 'Invalid time inputted');
      return;
    }
    try {
      $this->due->setTime($hours, $mins);
    } catch (InvalidArgumentException $e) {
      $this->addError('due_time', 'Invalid time inputted');
    }
  }

  /**
   * Get the assignment's due date
   *
   * @return string
   */
  public function getDate(): string {
    return $this->due->toDateString();
  }

  /**
   * Set the assignment's due date
   *
   * @param string $date
   * @return void
   */
  public function setDate(string $date): void {
    try {
      $date = Carbon::parse($date);
      $this->due->setDate($date->year, $date->month, $date->day);
    } catch (InvalidFormatException $e) {
    };
  }

  /**
   * Validates updated properties
   * @param  mixed $propertyName
   * @return void
   */
  public function updated($propertyName) {
    $this->validateOnly($propertyName);
  }

  /**
   * Render the component
   *
   * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
   */
  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();
    if ($this->assignment->link != null) {
      $this->preview = !$this->errorBag->has('assignment.link') ? LinkPreview::create($this->assignment->link)->updatePreview($this->assignment->link) : LinkPreview::create($this->assignment->link)->withError();
    }

    return view('livewire.assignments.assignment-edit')->with('preview', $this->preview);
  }
}
