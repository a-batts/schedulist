<?php

namespace App\Http\Livewire\Schedule;

use App\Enums\EventCategory;
use App\Enums\EventFrequency;
use App\Models\Event;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EventEdit extends Component
{
    /**
     * The event being edited
     *
     * @var Event
     */
    public Event $event;

    /**
     * Collection of user's events
     *
     * @var Collection
     */
    public Collection $events;

    /**
     * Valid category options for event
     *
     * @var array
     */
    public array $categories = [];

    /**
     * Valid frequency options for event
     *
     * @var array
     */
    public array $frequencies = [];

    public array $errorMessages = [];

    protected $listeners = [
        'eventAdded' => 'addEvent',
        'eventDeleted' => 'removeEvent',
    ];

    /**
     * Validation rules
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'event.name' => 'required',
            'event.date' => 'required|date',
            'event.end_date' => 'nullable|date',
            'event.start_time' => 'required',
            'event.end_time' => 'required',
            'event.frequency' => ['required', new Enum(EventFrequency::class)],
            'event.interval' => 'required',
            'event.days' => [
                'array',
                Rule::requiredIf(
                    $this->event->frequency == EventFrequency::Weekly
                ),
            ],
            'event.category' => ['required', new Enum(EventCategory::class)],
            'event.location' => 'nullable|string',
        ];
    }

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount(): void
    {
        $this->events = Auth::user()->ownedEvents->keyBy('id');
        $this->event = new Event();

        $this->categories = array_map(
            fn(EventCategory $item) => [
                'name' => $item->name,
                'value' => $item->value,
                'formatted_name' => $item->formattedName(),
            ],
            EventCategory::cases()
        );

        $this->frequencies = array_map(
            fn(EventFrequency $item) => [
                'name' => $item->name,
                'value' => $item->value,
                'unit' => $item->getUnit(),
            ],
            EventFrequency::cases()
        );
    }

    /**
     * Edit the selected event
     *
     * @return void
     */
    public function edit(): void
    {
        $event = $this->event;
        if ($event->owner == Auth::id()) {
            $this->validate();
            $this->dispatchBrowserEvent('close-edit-modal');
            if ($event->frequency != EventFrequency::Weekly) {
                $event->days = null;
            }
            $event->save();

            $this->events[$event->id] = $event;

            $this->emit('updateAgendaData');
            $this->emit('toastMessage', 'Event was successfully updated');
        }
    }

    /**
     * Update an event in the events list
     *
     * @param integer $id
     * @return void
     */
    public function addEvent(int $id): void
    {
        try {
            $this->events[$id] = Event::where([
                'id' => $id,
                'owner' => Auth::id(),
            ])->firstOrFail();
        } catch (ModelNotFoundException) {
            echo 'fail';
        }
    }

    /**
     * Remove an event from the events list
     *
     * @param integer $id
     * @return void
     */
    public function removeEvent(int $id): void
    {
        $this->event = new Event();
        $this->events->forget($id);
    }

    /**
     * Set the current event to edit and fetch data
     *
     * @param mixed $id
     * @return array
     */
    public function selectEditEvent($id): array|false
    {
        $this->clearValidation();
        try {
            $this->event = $this->events->firstOrFail('id', $id);
            return $this->getEventData();
        } catch (ItemNotFoundException) {
            $this->emit('toastMessage', 'Unable to load that event');
            return false;
        }
    }

    /**
     * Get the event's data - used from Alpine
     *
     * @return array
     */
    public function getEventData(): array
    {
        return [
            'frequency' => $this->event->frequency->value,
            'interval' => $this->event->interval,
            'days' => $this->event->days ?? [],
            'start_time' => $this->event->start_time,
            'end_time' => $this->event->end_time,
            'date' => $this->event->date,
            'end_date' =>
                $this->event->end_date ?? $this->event->date->copy()->addDay(),
        ];
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
     * Set the event's date
     *
     * @param string $time
     * @return void
     */
    public function setDate(string $date): void
    {
        try {
            $this->event->date = Carbon::parse($date);
        } catch (InvalidFormatException) {
        }
    }

    /**
     * Set the event's end date
     *
     * @param string|null $time
     * @return void
     */
    public function setEndDate(?string $date): void
    {
        try {
            if (isset($date)) {
                $this->event->end_date = Carbon::parse($date);
            } else {
                $this->event->end_date = null;
            }
        } catch (InvalidFormatException) {
        }
    }

    /**
     * Set the event's category
     *
     * @param string $value
     * @return void
     */
    public function setCategory(string $value): void
    {
        $this->event->category = $value;
    }

    /**
     * Reset the event back to its initial state
     *
     * @return void
     */
    public function resetEvent(): void
    {
        $this->event = new Event();
    }

    /**
     * Validate updated properties
     * @param  string $propertyName
     * @return void
     */
    public function updated(string $propertyName): void
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

        return view('livewire.schedule.event-edit');
    }
}
