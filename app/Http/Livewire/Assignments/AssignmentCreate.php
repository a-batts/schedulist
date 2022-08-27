<?php

namespace App\Http\Livewire\Assignments;

use App\Models\Classes;
use App\Models\Assignment;
use App\Models\AssignmentReminder;

use Carbon\Carbon;
use Carbon\Exceptions;
use Carbon\Exceptions\InvalidArgumentException;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;

use Livewire\Component;

class AssignmentCreate extends Component {

  /**
   * The new assignment to create
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

  public array $errorMessages = [];

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
    'assignment.assignment_name' => 'required',
    'assignment.classid' => 'nullable',
    'due' => 'required',
    'assignment.assignment_link' => 'url|nullable',
    'assignment.description' => 'required',
    'assignment.status' => 'required',
    'assignment.userid' => 'required',
  ];

  /**
   * Mount component
   * @return void
   */
  public function mount(): void {
    $this->assignment = new Assignment;

    $this->assignment->userid = Auth::User()->id;

    $this->due = Carbon::now();
    $this->due->setTime('23', '59', '59');

    $this->assignment->status = 'inc';

    $classes = Classes::where('userid', Auth::User()->id)->get();
    foreach ($classes as $class)
      $this->classes[] = ['id' => $class->id, 'name' => $class->name];
  }

  /**
   * Create the new assignment
   *
   * @return void
   */
  public function create(): void {
    $this->validate();
    $assignment = $this->assignment;

    if ($assignment->classid == -1)
      $assignment->classid = null;

    $assignment->due = $this->due;
    $assignment->url_string = Str::random(16);
    $assignment->name = Crypt::encryptString($assignment->name);
    $assignment->description = Crypt::encryptString($assignment->description);

    $assignment->link = isset($assignment->link) ? Crypt::encryptString($assignment->link) : null;

    $assignment->save();

    $this->dispatchBrowserEvent('close-dialog');
    $this->clear();
    $this->emit('refreshAssignments');
    $this->emit('toastMessage', 'Assignment was successfully created');

    //Create base assignment reminder
    $due = $assignment->due->copy();
    $reminder = new AssignmentReminder;
    $reminder->assignment_id = $assignment->id;
    $reminder->reminder_time = $due->subHours(1);
    $reminder->save();
  }

  /**
   * Reset the fields after creating a new assignment
   *
   * @return void
   */
  public function clear(): void {
    $this->assignment = new Assignment;

    $this->assignment->userid = Auth::User()->id;

    $this->due = Carbon::now();
    $this->due->setTime('23', '59', '59');

    $this->assignment->status = 'inc';
  }

  /**
   * Set the assignment's class
   *
   * @param int $val
   * @return void
   */
  public function setClass(int $id): void {
    if (Classes::where('id', $id)->where('userid', Auth::User()->id)->exists() || $id == -1)
      $this->assignment->classid = $id;
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
   * Validate updated properties
   * @param  mixed $propertyName
   * @return void
   */
  public function updated($propertyName): void {
    $this->validateOnly($propertyName);
  }

  /**
   * Render the component
   *
   * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
   */
  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();

    return view('livewire.assignments.assignment-create');
  }
}
