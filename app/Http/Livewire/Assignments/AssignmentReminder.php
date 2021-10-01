<?php

namespace App\Http\Livewire\Assignments;

use App\Models\Assignment;
use App\Models\AssignmentReminder as ModelsAssignmentReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class AssignmentReminder extends Component {

    public Assignment $assignment;

    public array $errorMessages;

    public $reminders;

    public function mount($assignment) {
        $this->assignment = $assignment;
        $this->reminders = $assignment->reminders()->with('assignment')->get()->toArray();
    }

    /**
     * Add reminder for specified assignment
     *
     * @param int $hoursBefore
     * @return void
     */
    public function addReminder($hoursBefore) {
        $due = Carbon::parse($this->assignment->due);
        $hoursBefore = round($hoursBefore);
        $validator = Validator::make(
            ['hoursBefore' => $hoursBefore],
            [
                'hoursBefore' => 'required|numeric',
            ],
            [
                'required' => 'Required',
            ]
        )->validate();

        if ($due->copy()->subHours($hoursBefore) < Carbon::now()) {
            $this->addError('hoursBefore', 'Can\'t set a reminder for a past time');
            return;
        }
        foreach ($this->reminders as $reminder) {
            if ($reminder['hours_before'] == $hoursBefore) {
                $this->addError('hoursBefore', 'You already have a reminder set for this time');
                return;
            }
        }
        $reminder = new ModelsAssignmentReminder();
        $reminder->assignment_id = $this->assignment->id;
        $reminder->reminder_time = $due->subHours($hoursBefore);
        $reminder->save();
        $this->reminders = $this->assignment->reminders()->get()->toArray();
        $this->dispatchBrowserEvent('update-reminders');
    }

    /**
     * Remove reminder for specified assignment
     *
     * @param int $id of reminder to be removed
     * @return void
     */
    public function removeReminder($id) {
        if ($this->assignment->owner = Auth::User()->id)
            ModelsAssignmentReminder::destroy($id);
        $this->reminders = $this->assignment->reminders()->get()->toArray();
    }

    public function render() {
        $this->errorMessages = $this->getErrorBag()->toArray();;
        return view('livewire.assignments.assignment-reminder');
    }
}
