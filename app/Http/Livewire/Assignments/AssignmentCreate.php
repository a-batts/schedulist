<?php

namespace App\Http\Livewire\Assignments;

use App\Models\Classes;
use App\Models\Assignment;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidArgumentException;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AssignmentCreate extends Component
{
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

    /**
     * Mount component
     * @return void
     */
    public function mount(): void
    {
        $this->initAssignment();

        Auth::user()->classes->map(function (Classes $class) {
            $this->classes[] = ['id' => $class->id, 'name' => $class->name];
        });
    }

    /**
     * Create the new assignment
     *
     * @return void
     */
    public function create(): void
    {
        $assignment = $this->assignment;
        $assignment->due = $this->due;
        $this->validate();

        if ($assignment->class_id == -1) {
            $assignment->class_id = null;
        }
        $assignment->url_string = Str::random(16);

        Auth::user()
            ->assignments()
            ->save($assignment);

        $this->dispatchBrowserEvent('close-dialog');
        $this->initAssignment();
        $this->emit('refreshAssignments');
        $this->emit('toastMessage', 'Assignment was successfully created');

        //Create base assignment reminder
        $assignment->reminders()->create([
            'reminder_time' => $assignment->due->copy()->subHours(1),
        ]);
    }

    /**
     * Reset the fields after creating a new assignment
     *
     * @return void
     */
    public function initAssignment(): void
    {
        $this->assignment = new Assignment();
        $this->due = Carbon::now()->setTime('23', '59', '59');
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
     * Validate updated properties
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName): void
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
        return view('livewire.assignments.assignment-create');
    }
}
