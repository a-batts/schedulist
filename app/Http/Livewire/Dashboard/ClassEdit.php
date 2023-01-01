<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Classes;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class ClassEdit extends Component {
  /**
   * The class that is being edited
   *
   * @var Classes
   */
  public Classes $editClass;

  /**
   * Array of the class's links
   *
   * @var array
   */
  public array $links = [];

  /**
   * Valid color options for the class
   *
   * @var array
   */
  private array $colorOptions = ['pink', 'orange', 'lemon', 'mint', 'blue', 'teal', 'purple', 'lav', 'beige'];

  public array $errorMessages = [];

  protected $listeners = ['deleteClass' => 'mount'];

  /**
   * Validation messages
   *
   * @return array
   */
  public function messages(): array {
    return [
      'links.*.name.required' => 'Link name is required',
      'links.*.link.required' => 'Link is required',
      'links.*.link.url' => 'Link must be valid URL',
      'links.*.link.distinct' => 'You\'ve already added this link',
    ];
  }

  /**
   * Validation rules
   *
   * @return array
   */
  public function rules(): array {
    return [
      'editClass.name' => 'required',
      'editClass.teacher' => 'required',
      'editClass.teacher_email' => 'nullable',
      'editClass.video_link' => 'nullable|url',
      'editClass.location' => 'nullable',
      'editClass.color' => 'required',
      'links.*' => 'array',
      'links.*.name' => 'required',
      'links.*.link' => 'required|url|distinct',
    ];
  }

  /**
   * Mount the component
   *
   * @return void
   */
  public function mount(): void {
    $this->editClass = new Classes(['color' => 'pink']);
  }

  /**
   * Edit the selected class
   *
   * @return void
   */
  public function edit(): void {
    $this->validate();

    $class = $this->editClass;

    if (!isset($class->teacher_email) || $class->teacher_email == '') $class->teacher_email = null;
    if (!isset($class->location) || $class->location == '') $class->location = null;
    if ($class->video_link == '') $class->video_link = null;

    $class->save();

    $class->links()->delete();
    foreach ($this->links as $link)
      $class->links()->create([
        'name' => $link['name'],
        'link' => $link['link']
      ]);

    $this->emit('refreshClasses');
    $this->dispatchBrowserEvent('close-dialog');
    $this->emit('toastMessage', 'Class successfully edited');
  }

  /**
   * Select the class to edit
   *
   * @param int $id
   * @return void
   */
  public function selectClass(int $id): void {
    try {
      $this->editClass = Auth::user()->classes()->findOrFail($id);
    } catch (ModelNotFoundException $e) {
    }
  }

  /**
   * Set the color of the class
   *
   * @param string $color
   * @return void
   */
  public function setColor(string $color): void {
    $this->editClass->color = $color;
  }

  /**
   * Validate updated properties
   * 
   * @param string $propertyName
   * @return void
   */
  public function updated(string $propertyName): void {
    $this->validateOnly($propertyName);
  }

  /**
   * Validate when links are updated
   *
   * @return void
   */
  public function updatedLinks(): void {
    $this->validate(
      [
        'links.*' => 'array',
        'links.*.name' => 'required',
        'links.*.link' => 'required|url|distinct',
      ]
    );
  }

  /**
   * Render the component
   *
   * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
   */
  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();

    return view('livewire.dashboard.class-edit')->with('colorOptions', $this->colorOptions);
  }
}
