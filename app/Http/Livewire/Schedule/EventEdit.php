<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Event;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EventEdit extends Component
{
    const DAYS = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

    /**
     * The event to edit
     *
     * @var Event
     */
    public Event $event;

    /**
     * Valid category options for event
     *
     * @var array
     */
    public array $categories = [
        'Club Meeting',
        'Final',
        'Game',
        'Job Shift',
        'Quiz',
        'Practice/Rehersal',
        'Test',
        'Volunteer Work',
        'Other',
    ];

    /**
     * Valid frequency options for event
     *
     * @var array
     */
    public array $frequencies = ['Day', 'Week', 'Two Weeks', 'Month'];

    /**
     * The set frequency for the event
     *
     * @var string
     */
    public string $frequency = '';

    /**
     * The days of the week for the event to reoccurr on
     *
     * @var array
     */
    public array $days = [];

    public array $errorMessages = [];

    protected $listeners = ['setEditEvent' => 'getEventToEdit'];

    /**
     * Validation rules
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'event.name' => 'required',
            'event.category' => ['required', Rule::in($this->categories)],
            'event.start_time' => 'required',
            'event.end_time' => 'required',
            'event.date' => 'required',
            'event.reoccuring' => 'required',
            'event.frequency' => Rule::requiredIf(
                $this->event->reoccuring == true
            ),
            'event.days' => Rule::requiredIf(
                $this->event->reoccuring == true &&
                    ($this->event->frequency == 'Week' ||
                        $this->event->frequency == 'Two Weeks')
            ),
        ];
    }

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount(): void
    {
        $this->event = new Event();
    }

    /**
     * Validate updated properties
     * @param  string $propertyName
     * @return void
     */
    public function updated(string $propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Edit the selected event
     *
     * @return void
     */
    public function edit(): void
    {
        $this->resetValidation();

        $event = $this->event;

        if ($event->owner == Auth::id()) {
            if ($event->reoccuring) {
                if ($this->frequency != null) {
                    switch ($this->frequency) {
                        case 'Day':
                            $event->frequency = 1;
                            break;
                        case 'Week':
                            $event->frequency = 7;
                            break;
                        case 'Two Weeks':
                            $event->frequency = 14;
                            break;
                        case 'Month':
                            $event->frequency = 31;
                            break;
                        default:
                            $event->frequency = null;
                            break;
                    }
                }
                $eventDay = Carbon::parse($this->event->date)->format('D');
                if (!in_array($eventDay, $this->days)) {
                    $this->days[] = $eventDay;
                }

                $isoVals = [];

                foreach ($this->days as $day) {
                    $isoVals[] = array_search($day, self::DAYS) + 1;
                }

                sort($isoVals);
                $event->days = implode(',', $isoVals);
            } else {
                $event->frequency = null;
                $event->days = null;
            }

            $this->validate();

            $event->save();
            $this->emit('updateAgendaData');
            $this->dispatchBrowserEvent('close-edit-modal');
            $this->emit('toastMessage', 'Event was successfully updated');
        }
    }

    /**
     * Set the current event to edit and get the data
     *
     * @param mixed $id
     * @return void
     */
    public function getEventToEdit($id): void
    {
        $this->clearValidation();

        $event = Event::find($id);

        if ($event->owner == Auth::id()) {
            switch ($event->frequency) {
                case 1:
                    $this->frequency = 'Day';
                    break;
                case 7:
                    $this->frequency = 'Week';
                    break;
                case 14:
                    $this->frequency = 'Two Weeks';
                    break;
                case 31:
                    $this->frequency = 'Month';
                    break;
            }

            $occuranceDays = $event->days;

            if (isset($occuranceDays) && $occuranceDays != '') {
                $vals = explode(',', $occuranceDays);

                foreach ($vals as $val) {
                    $days[] = self::DAYS[$val - 1];
                }

                $this->days = $days;
            }

            $this->event = $event;
            $this->dispatchBrowserEvent('update-content');
        }
    }

    /**
     * Set the event's category
     *
     * @param string $category
     * @return void
     */
    public function setCategory(string $category): void
    {
        if (!in_array($category, $this->categories)) {
            throw ValidationException::withMessages([
                'event.category' => 'You\'ve selected an invalid category.',
            ]);
        }

        $this->event->category = $category;
    }

    /**
     * Get the event's start time
     *
     * @return string
     */
    public function getStartTime(): string
    {
        return $this->event->start_time;
    }

    /**
     * Set the event's start time
     *
     * @param array $time
     * @return void
     */
    public function setStartTime(array $time): void
    {
        $hours = $time['h'];
        $mins = $time['m'];

        if ($hours < 0 || $hours > 23 || $mins < 0 || $mins > 59) {
            throw ValidationException::withMessages([
                'start_time' => 'Invalid start time',
            ]);
        }

        //Ensure that the start time is not after the end time
        $endTime = explode(':', $this->event->end_time);
        if (
            $endTime[0] < $hours ||
            ($endTime[0] == $hours && $endTime[1] < $mins)
        ) {
            throw ValidationException::withMessages([
                'start_time' =>
                    'The event start time must be before the end time.',
            ]);
        }

        $this->event->start_time =
            $hours . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
    }

    public function getEndTime(): string
    {
        return $this->event->end_time;
    }

    /**
     * Set the event's end time
     *
     * @param array $time
     * @return void
     */
    public function setEndTime(array $time): void
    {
        $hours = $time['h'];
        $mins = $time['m'];

        if ($hours < 0 || $hours > 23 || $mins < 0 || $mins > 59) {
            throw ValidationException::withMessages([
                'end_time' => 'Invalid end time',
            ]);
        }

        //Ensure that the end time is not before the start time
        $startTime = explode(':', $this->event->start_time);
        if (
            $startTime[0] > $hours ||
            ($startTime[0] == $hours && $startTime[1] > $mins)
        ) {
            throw ValidationException::withMessages([
                'end_time' =>
                    'The event end time must be after the start time.',
            ]);
        }

        $this->event->end_time =
            $hours . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
    }

    /**
     * Get the event's date
     *
     * @return string
     */
    public function getDate(): string
    {
        return Carbon::parse($this->event->date)->toDateString();
    }

    /**
     * Set the event's date
     *
     * @param string $time
     * @return void
     */
    public function setDate(string $date): void
    {
        try {
            $date = Carbon::parse($date)->toDateString();
            $this->event->date = $date;
        } catch (InvalidFormatException $e) {
        }
    }

    /**
     * Get whether or not the event is reoccuring
     *
     * @return boolean
     */
    public function getReoccuring(): bool
    {
        return (bool) $this->event->reoccuring;
    }

    /**
     * Get the event reoccurance days
     *
     * @return array
     */
    public function getDays(): array
    {
        return $this->days;
    }

    /**
     * Set the event reoccurance days
     *
     * @param array $val
     * @return void
     */
    public function setDays($val): void
    {
        $this->days = $val;
    }

    /**
     * Render the component
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        $this->errorMessages = $this->getErrorBag()->toArray();

        return view('livewire.schedule.event-edit');
    }
}
