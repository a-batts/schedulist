<?php

namespace App\Http\Livewire\Assignments;

use App\Models\Classes;
use App\Models\Assignment;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Livewire\Component;

class AssignmentList extends Component {

  /**
   * Array of user's assignments
   *
   * @var array
   */
  public array $assignments;

  /**
   * Array of user's created classes
   *
   * @var array
   */
  public array $classes = [];

  /**
   * The selected class provided by URL paramater
   *
   * @var Classes|int|null
   */
  public $class;

  /**
   * The selected completion filter provided by URL paramater
   *
   * @var string
   */
  public string $due = 'Incomplete';

  /**
   * Valid completion filter options
   *
   * @var array
   */
  public array $filters = ['Incomplete', 'Completed'];

  protected $listeners = ['refreshAssignments'];

  /**
   * Mount the component
   *
   * @return void
   */
  public function mount(): void {
    $usersClasses = Classes::where('user_id', Auth::id())->get();
    foreach ($usersClasses as $class)
      $this->classes[] = ['id' => $class->id, 'name' => $class->name];

    if ($this->class != -1)
      $this->class = Classes::where('id', (int) $this->class)->where('user_id', Auth::id())->first()->id;

    $this->assignments = $this->getAssignments();
  }

  /**
   * Return array of the user's assignmetns
   *
   * @return array
   */
  public function getAssignments(): array {
    $assignments = Assignment::where('user_id', Auth::id())->orderBy('due', 'asc')->get()->toArray();
    foreach ($assignments as $key => $value) {
      $due = Carbon::parse($value['due']);

      $assignments[$key]['due_time'] = $due->format('g:i A');
      $assignments[$key]['due_date'] = $due->format('M j, Y');

      $assignments[$key]['link'] = $value['link'];

      if ($value['class_id'] != null) {
        $k = array_search($value['class_id'], array_column($this->classes, 'id'));
        if ($k === false)
          $assignments[$key]['class_name'] = 'Deleted Class';
        else
          $assignments[$key]['class_name'] = $this->classes[$k]['name'];
      } else
        $assignments[$key]['class_name'] = 'No Class';
    }
    return $assignments;
  }

  /**
   * Return the name of a specific class
   *
   * @param int $id
   * @return string
   */
  public function getClassName($id): string {
    if ($id >= 0) {
      foreach ($this->classes as $class) {
        if ($class['id'] == $id)
          return $class['name'];
      }
    }

    return '';
  }

  /**
   * Update the user's assignments
   *
   * @return void
   */
  public function refreshAssignments(): void {
    $this->assignments = $this->getAssignments();
    $this->dispatchBrowserEvent('update-assignments');
  }

  /**
   * Toggle an assignment's completion status
   *
   * @param int $id
   * @return void
   */
  public function toggleCompletion($id): void {
    $assignment = Assignment::findOrFail($id);

    //Only allow user to modify an assignment they own
    if ($assignment->user_id == Auth::id()) {
      $assignment->status = $assignment->status->inverse();
      $assignment->save();
      $this->refreshAssignments();
      $this->emit('toastMessage', 'Marked assignment as ' . (strtolower($assignment->status->name)));
    }
  }

  /**
   * Mount the component
   *
   * @return Illuminate\Contracts\View\View|Illuminate\Contracts\View\Factory
   */
  public function render() {
    return view('livewire.assignments.assignment-list');
  }
}
