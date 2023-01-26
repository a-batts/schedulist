<?php

namespace App\Http\Livewire\Assignments;

use App\Classes\LinkPreview;

use App\Models\Assignment;
use App\Models\AssignmentReminder;
use App\Models\Classes;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidArgumentException;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AssignmentEdit extends Component
{
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
     * Validation rules
     *
     * @var array
     */
    protected array $rules = [
        'assignment.class_id' => 'nullable',
        'assignment.description' => 'nullable',
        'assignment.due' => 'date|required',
        'assignment.link' => 'url|nullable',
        'assignment.name' => 'required',
    ];

    /**
     * Error messages
     *
     * @var array
     */
    protected array $messages = [
        'url' => 'Make sure the link is a valid URL',
    ];

    public array $errorMessages = [];

    protected $listeners = ['refreshEditModal' => '$refresh'];

    /**
     * Mount component
     * @return void
     */
    public function mount()
    {
        $this->due = Carbon::parse($this->assignment->due);

        Auth::user()->classes->map(function (Classes $class) {
            $this->classes[] = ['id' => $class->id, 'name' => $class->name];
        });
    }

    /**
     * Save updated assignment
     * @return void
     */
    public function edit()
    {
        $assignment = $this->assignment;
        if ($assignment->due !== $this->due) {
            $this->assignment->reminders->map(function (
                AssignmentReminder $reminder
            ) {
                $reminder->reminder_time = $this->due
                    ->copy()
                    ->subHours($reminder->hours_before);
                $reminder->save();
            });
        }

        $assignment->due = $this->due;
        $this->validate();
        $this->dispatchBrowserEvent('hide-edit-menu');

        if ($assignment->link == null) {
            $assignment->link_image = null;
            $assignment->link_description = null;
        } else {
            $this->preview = LinkPreview::create(
                $assignment->link
            )->updatePreview($assignment->link);
            $assignment->link_image = $this->preview->getPreview();
            $assignment->link_description = $this->preview->getText();
        }

        $assignment->save();
        $this->emit('toastMessage', 'Changes successfully saved');
        $this->emit('refreshAssignmentPage');
    }

    /**
     * Delete assignment
     * @return void
     */
    public function delete(): void
    {
        $this->assignment->delete();
        $this->redirect(route('assignments'));
        $this->emit('toastMessage', 'Assignment was deleted');
    }

    /**
     * Set the assignment's class
     *
     * @param int $val
     * @return void
     */
    public function setClass(int $id): void
    {
        if (
            Classes::where('id', $id)
                ->where('user_id', Auth::id())
                ->exists() ||
            $id == -1
        ) {
            $this->assignment->class_id = $id;
        }
    }

    /**
     * Get the assignment's due time
     *
     * @return string
     */
    public function getTime(): string
    {
        return $this->due->format('H:i');
    }

    /**
     * Set the assignment's due time
     *
     * @param array $time
     * @return void
     */
    public function setTime(array $time): void
    {
        $hours = $time['h'];
        $mins = $time['m'];

        if ($hours < 0 || $hours > 23 || $mins < 0 || $mins > 59) {
            throw ValidationException::withMessages([
                'due_time' => 'Invalid time inputted',
            ]);
        }
        try {
            $this->due->setTime($hours, $mins);
        } catch (InvalidArgumentException) {
            throw ValidationException::withMessages([
                'due_time' => 'Invalid time inputted',
            ]);
        }
    }

    /**
     * Get the assignment's due date
     *
     * @return string
     */
    public function getDate(): string
    {
        return $this->due->toDateString();
    }

    /**
     * Set the assignment's due date
     *
     * @param string $date
     * @return void
     */
    public function setDate(string $date): void
    {
        try {
            $date = Carbon::parse($date);
            $this->due->setDate($date->year, $date->month, $date->day);
        } catch (InvalidFormatException) {
        }
    }

    /**
     * Validates updated properties
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Render the component
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        $this->errorMessages = $this->getErrorBag()->toArray();
        if ($this->assignment->link != null) {
            $this->preview = !$this->errorBag->has('assignment.link')
                ? LinkPreview::create($this->assignment->link)->updatePreview(
                    $this->assignment->link
                )
                : LinkPreview::create($this->assignment->link)->withError();
        }

        return view('livewire.assignments.assignment-edit')->with(
            'preview',
            $this->preview
        );
    }
}
