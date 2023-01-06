<?php

namespace App\Http\Livewire\Assignments;

use App\Classes\LinkPreview;
use App\Models\Classes;
use App\Models\Assignment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

use Livewire\Component;

class AssignmentContent extends Component {
  /**
   * The assignment
   *
   * @var Assignment
   */
  public Assignment $assignment;

  /**
   * The assignment's notes
   *
   * @var Collection<AssignmentNote>
   */
  public $notes;

  /**
   * The unique encode string for the assignment (used to access it)
   *
   * @var string
   */
  public string $urlString;

  /**
   * The color of the assignment's class
   *
   * @var string 
   */
  public string $classColor;

  /**
   * The new note contents
   *
   * @var string
   */
  public string $noteContent = '';

  /**
   * The link preview for the assignment link
   *
   * @var LinkPreview|null
   */
  protected ?LinkPreview $preview;

  /**
   * Validation rules
   *
   * @var array
   */
  protected array $rules = [
    'noteContent' => 'required',
  ];

  protected $listeners = ['refreshAssignmentPage' => '$refresh'];

  /**
   * Mount the component
   *
   * @return void
   */
  public function mount(): void {
    $this->assignment = Assignment::where('url_string', $this->urlString)->first();

    if ($this->assignment->class_id != null)
      $class = Classes::where('id', $this->assignment->class_id)->first();

    $this->classColor = isset($class) ? strtolower($class->color) : 'blue';

    $this->notes = $this->assignment->notes;
  }

  /**
   * Toggle the assignment's completion status
   *
   * @return void
   */
  public function toggleCompletion(): void {
    $assignment = $this->assignment;

    $assignment->status = $assignment->status->inverse();
    $assignment->save();
    $this->emit('toastMessage', 'Marked assignment as ' . (strtolower($assignment->status->name)));
  }

  /**
   * Add a new note
   *
   * @return void
   */
  public function addNote(): void {
    $this->clearValidation();
    $this->validate();

    $this->assignment->notes()->create([
      'content' => $this->noteContent,
    ]);

    $this->reset('noteContent');

    $this->mount();
  }

  /**
   * Delete a specified note
   *
   * @param int $id
   * @return void
   */
  public function deleteNote(int $id): void {
    try {
      $this->assignment->notes()->findOrFail($id)->delete();
      $this->emit('toastMessage', 'Note successfully deleted');

      $this->mount();
    } catch (ModelNotFoundException $e) {
    }
  }

  /**
   * Render the component
   *
   * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
   */
  public function render() {
    $this->preview = LinkPreview::create($this->assignment->link);
    $this->preview = ($this->assignment->link_description == null) || ($this->assignment->link_image == null) ? $this->preview->withoutExisting() : $this->preview->withExisting($this->assignment->link_image, $this->assignment->link_description);

    return view('livewire.assignments.assignment-content')->with('preview', $this->preview);
  }
}
