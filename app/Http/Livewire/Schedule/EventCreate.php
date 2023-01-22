<?php

namespace App\Http\Livewire\Schedule;

use App\Enums\EventCategory;
use App\Enums\EventFrequency;
use App\Models\Event;
use App\Models\EventUser;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EventCreate extends Component
{
    /**
     * The new event
     *
     * @var Event
     */
    public Event $event;

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

    /**
     * The days of the week for the event to reoccur on
     *
     * @var array
     */
    public array $days = [];

    public array $errorMessages = [];

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
        $this->initEvent();

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
     * Create the new event
     *
     * @return void
     */
    public function create(): void
    {
        $this->validate();
        $event = $this->event;
        $event->color = 'blue';

        if ($event->frequency != EventFrequency::Weekly) {
            $event->days = null;
        }

        $this->dispatchBrowserEvent('close-create-modal');

        $event->owner = Auth::id();
        $event->save();
        EventUser::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'accepted' => true,
        ])->save();

        $this->emit('updateAgendaData');
        $this->emit('eventAdded', $event->id);
        $this->emit('toastMessage', 'Event was successfully created');
        $this->initEvent();
    }

    /**
     * Initiate the new event
     *
     * @return void
     */
    public function initEvent(): void
    {
        $this->event = new Event([
            'date' => Carbon::now()->toDateString(),
            'start_time' => Carbon::now()->format('H:i'),
            'end_time' => '23:59',
            'frequency' => EventFrequency::Never,
            'interval' => 1,
        ]);
    }

    /**
     * Set the event's start time
     *
     * @param array $time
     * @return void
     * @throws ValidationException
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
     * @throws ValidationException
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
     * Validate updated property
     * @param  mixed $propertyName
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
        return view('livewire.schedule.event-create');
    }
}
