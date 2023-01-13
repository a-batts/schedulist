<?php

namespace App\Http\Livewire\Schedule;

use App\Enums\EventCategory;
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
    const DAYS = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

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
    public array $frequencies = ['Day', 'Week', 'Two Weeks', 'Month'];

    /**
     * The set frequency for the event
     *
     * @var string|null
     */
    public ?string $frequency = '';

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
            'event.category' => ['required', new Enum(EventCategory::class)],
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

        $this->event->date = Carbon::now()->toDateString();
        $this->event->start_time = Carbon::now()->format('H:i');
        $this->event->end_time = '23:59';

        $this->event->reoccuring = false;

        $this->categories = $this->getEventCategories();
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
     * Create the new event
     *
     * @return void
     */
    public function create(): void
    {
        $this->resetValidation();

        $event = $this->event;

        if ($this->event->reoccuring) {
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
            $this->event->days = implode(',', $isoVals);
        }

        $this->validate();
        $this->dispatchBrowserEvent('close-create-modal');

        $event->owner = Auth::id();
        $event->color = 'blue';

        $event->save();

        $this->emit('updateAgendaData');
        $this->emit('toastMessage', 'Event was successfully created');

        EventUser::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'accepted' => true,
        ])->save();
    }

    /**
     * Get the array of all event category enums
     *
     * @return array
     */
    public function getEventCategories(): array
    {
        $levels = [];
        foreach (EventCategory::cases() as $case) {
            $levels[] = [
                'name' => $case->name,
                'value' => $case->value,
                'formatted_name' => $case->formattedName(),
            ];
        }
        return $levels;
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
            $date = Carbon::parse($date)->toDateString();
            $this->event->date = $date;
        } catch (InvalidFormatException $e) {
        }
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
