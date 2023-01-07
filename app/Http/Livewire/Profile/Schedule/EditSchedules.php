<?php

namespace App\Http\Livewire\Profile\Schedule;

use App\Models\ClassSchedule;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EditSchedules extends Component
{
    /**
     * Collection of a user's schedules
     *
     * @var Collection
     */
    public Collection $schedules;

    /**
     * The schedule name
     *
     * @var string
     */
    public string $name = '';

    /**
     * The start date of the schedule being modified
     *
     * @var Carbon
     */
    public Carbon $start;

    /**
     * The end date of the schedule being modified
     *
     * @var Carbon
     */
    public Carbon $end;

    protected $rules = [
        'name' => 'required',
        'start' => 'required',
        'end' => 'required',
    ];

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount(): void
    {
        $this->schedules = Auth::user()
            ->schedules()
            ->get()
            ->keyBy('id');
        $this->start = Carbon::now();
        $this->end = Carbon::now()->addDay();
    }

    /**
     * Create a new schedule
     *
     * @return void
     */
    public function create(): void
    {
        $this->validate();

        $newSchedule = new ClassSchedule();

        $newSchedule->name = $this->name;
        $newSchedule->start_date = $this->start->toDateString();
        $newSchedule->end_date = $this->end->toDateString();

        if ($this->checkForOverlap()) {
            throw ValidationException::withMessages([
                'start_date' =>
                    'Your new schedule cannot overlap with your other schedules.',
            ]);
        }

        Auth::user()
            ->schedules()
            ->save($newSchedule);
        $this->schedules->add($newSchedule);

        $this->start = Carbon::now();
        $this->end = Carbon::now()->addDay();
    }

    /**
     * Edit an existing schedule
     *
     * @return void
     */
    public function edit(int $id)
    {
        $this->validate();

        try {
            $editSchedule = Auth::user()
                ->schedules()
                ->findOrFail($id);
            $editSchedule->name = $this->name;
            $editSchedule->start_date = $this->start->toDateString();
            $editSchedule->end_date = $this->end->toDateString();

            if ($this->checkForOverlap($id)) {
                throw ValidationException::withMessages([
                    'start_date' =>
                        'The new dates for this schedule cannot overlap with your other schedules.',
                ]);
            }

            $editSchedule->save();

            foreach ($this->schedules as $schedule) {
                if ($schedule->id == $id) {
                    $schedule = $editSchedule;
                }
            }

            $this->start = Carbon::now();
            $this->end = Carbon::now()->addDay();
        } catch (ModelNotFoundException) {
        }
    }

    /**
     * Delete the specified schedule
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id): void
    {
        try {
            Auth::user()
                ->schedules()
                ->findOrFail($id)
                ->delete();
            $this->schedules = $this->schedules->except($id);
        } catch (ModelNotFoundException $e) {
        }
    }

    /**
     * Get array representation of the user's schedules
     *
     * @return array
     */
    public function getSchedulesArray(): array
    {
        return $this->schedules->toArray();
    }

    /**
     * Set the event's start date
     *
     * @param string $date
     * @return void
     */
    public function setStartDate(string $date): void
    {
        try {
            $date = Carbon::parse($date);
            if ($date < $this->end) {
                $this->start = $date;
            } else {
                $this->addError(
                    'start_date',
                    'The start date needs to be before the end date'
                );
            }
        } catch (InvalidFormatException $e) {
        }
    }

    /**
     * Set the event's end date
     *
     * @param string $date
     * @return void
     */
    public function setEndDate(string $date): void
    {
        try {
            $date = Carbon::parse($date);
            if ($date > $this->start) {
                $this->end = $date;
            } else {
                $this->addError(
                    'end_date',
                    'The end date needs to be before the start date'
                );
            }
        } catch (InvalidFormatException $e) {
        }
    }

    /**
     * Check if the schedule that's being edited will overlap with others
     *
     * @param integer|null $id
     * @return boolean
     */
    public function checkForOverlap(?int $id = null): bool
    {
        $start = $this->start->copy()->startOfDay();
        $end = $this->end->copy()->endOfDay();

        foreach ($this->schedules as $each) {
            $eachStart = Carbon::parse($each->start_date)->startOfDay();
            $eachEnd = Carbon::parse($each->end_date)->startOfDay();
            if (
                ($start >= $eachStart && $start <= $eachEnd) ||
                ($end >= $eachStart && $end <= $eachEnd) ||
                ($start <= $eachStart && $end >= $eachEnd)
            ) {
                if ($id != null) {
                    if ($id != $each->id) {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        }
        return false;
    }

    public function render()
    {
        return view('livewire.profile.schedule.edit-schedules')
            ->layout('layouts.app')
            ->layoutData(['title' => '  Manage Your Schedules']);
    }
}
