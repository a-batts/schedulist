<?php

namespace App\Http\Livewire\Assignments;

use App\Models\Assignment;
use App\Models\AssignmentReminder as ModelsAssignmentReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AssignmentReminder extends Component
{
    /**
     * The assignment
     *
     * @var Assignment
     */
    public Assignment $assignment;

    /**
     * Array of the assignment's reminders
     *
     * @var array
     */
    public array $reminders;

    public array $errorMessages;

    /**
     * Mount the component
     *
     * @param Assignment $assignment
     * @return void
     */
    public function mount(Assignment $assignment): void
    {
        //Load the assignment from the view component
        $this->assignment = $assignment;

        $this->reminders = $assignment
            ->reminders()
            ->with('assignment')
            ->get()
            ->toArray();
    }

    /**
     * Add a reminder for the specified number of hours before the reminder
     *
     * @param int $hoursBefore
     * @return array|null
     */
    public function addReminder(int $hoursBefore): ?array
    {
        $hoursBefore = round($hoursBefore);

        if ($hoursBefore < 1 || $hoursBefore > 48) {
            throw ValidationException::withMessages([
                'hoursBefore' =>
                    'You can set a reminder for no more than 48 hours prior to the assignment due date',
            ]);
        }

        Validator::make(
            ['hoursBefore' => $hoursBefore],
            [
                'hoursBefore' => 'required|numeric',
            ],
            [
                'required' => 'Required',
            ]
        )->validate();

        $due = Carbon::parse($this->assignment->due);

        if ($due->copy()->subHours($hoursBefore) < Carbon::now()) {
            throw ValidationException::withMessages([
                'hoursBefore' => 'You can\'t set a reminder for a past time',
            ]);
        }

        foreach ($this->reminders as $reminder) {
            if ($reminder['hours_before'] == $hoursBefore) {
                throw ValidationException::withMessages([
                    'hoursBefore' =>
                        'You already have a reminder set for this time',
                ]);
            }
        }

        $reminder = new ModelsAssignmentReminder();
        $reminder->reminder_time = $due->subHours($hoursBefore);
        $this->assignment->reminders()->save($reminder);

        //Add the newly created reminder to the reminders array, makes it so that a new query isn't necessary
        $this->reminders[] = $reminder->toArray();
        return $reminder->toArray();
    }

    /**
     * Remove reminder for specified assignment
     *
     * @param int $id of reminder to be removed
     * @return void
     */
    public function removeReminder($id): void
    {
        if ($this->assignment->owner = Auth::id()) {
            ModelsAssignmentReminder::destroy($id);
        }
        $this->reminders = $this->assignment
            ->reminders()
            ->get()
            ->toArray();
    }

    /**
     * Render the component
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        $this->errorMessages = $this->getErrorBag()->toArray();
        return view('livewire.assignments.assignment-reminder');
    }
}
