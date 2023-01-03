<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Event;
use App\Models\EventUser;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

use Livewire\Component;

class EventCreate extends Component {

  const DAYS = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

  /**
   * The new evemt
   *
   * @var Event
   */
  public Event $event;

  /**
   * Valid category options for event
   *
   * @var array
   */
  public array $categories = ['Club Meeting', 'Final', 'Game', 'Job Shift', 'Quiz', 'Practice/Rehersal', 'Test', 'Volunteer Work', 'Other'];

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
   * The days of the week for the event to reoccurr on
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
  protected function rules(): array {
    return [
      'event.name' => 'required',
      'event.category' => ['required', Rule::in($this->categories)],
      'event.start_time' => 'required',
      'event.end_time' => 'required',
      'event.date' => 'required',
      'event.reoccuring' => 'required',
      'event.frequency' => Rule::requiredIf($this->event->reoccuring == true),
      'event.days' => Rule::requiredIf($this->event->reoccuring == true && ($this->event->frequency == 'Week' || $this->event->frequency == 'Two Weeks')),
    ];
  }

  /**
   * Mount the component
   *
   * @return void
   */
  public function mount(): void {
    $this->event = new Event();

    $this->event->date = Carbon::now()->toDateString();
    $this->event->start_time = Carbon::now()->format('H:i');
    $this->event->end_time = '23:59';

    $this->event->reoccuring = false;
  }

  /**
   * Validate updated property
   * @param  mixed $propertyName
   * @return void
   */
  public function updated(string $propertyName): void {
    $this->validateOnly($propertyName);
  }

  /**
   * Create the new event
   *
   * @return void
   */
  public function create(): void {
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
      if (!in_array($eventDay, $this->days))
        $this->days[] = $eventDay;

      $isoVals = [];

      foreach ($this->days as $day)
        $isoVals[] = array_search($day, Self::DAYS) + 1;

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

    $eventUser = new EventUser(['user_id' => Auth::id(), 'event_id' => $event->id, 'accepted' => true]);
    $eventUser->save();
  }

  /**
   * Set the event category
   *
   * @param string $category
   * @return void
   */
  public function setCategory(string $category): void {
    if (in_array($category, $this->categories)) {
      $this->event->category = $category;
      $this->clearValidation('event.category');
    } else
      $this->addError('event.category', 'You\'ve selected an invalid category');
  }

  /**
   * Set the event's start time
   *
   * @param array $time
   * @return void
   */
  public function setStartTime(array $time): void {
    $hours = $time['h'];
    $mins = $time['m'];

    if ($hours < 0 || $hours > 23 || $mins < 0 || $mins > 59) {
      $this->addError('start_time', 'Invalid start time');
      return;
    }

    //Ensure that the start time is not after the end time
    $endTime = explode(':', $this->event->end_time);
    if (
      ($endTime[0] < $hours || ($endTime[0] == $hours && $endTime[1] < $mins))
    ) {
      $this->addError('start_time', 'The event end time must be after the start time');
      return;
    }

    $this->event->start_time = $hours . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
  }

  /**
   * Set the event's end time
   *
   * @param array $time
   * @return void
   */
  public function setEndTime(array $time): void {
    $hours = $time['h'];
    $mins = $time['m'];

    if ($hours < 0 || $hours > 23 || $mins < 0 || $mins > 59) {
      $this->addError('start_time', 'Invalid end time');
      return;
    }

    //Ensure that the end time is not before the start time
    $startTime = explode(':', $this->event->start_time);
    if (
      ($startTime[0] > $hours || ($startTime[0] == $hours && $startTime[1] > $mins))
    ) {
      $this->addError('end_time', 'The event end time must be after the start time');
      return;
    }

    $this->event->end_time = $hours . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
  }

  /**
   * Set the event's date
   *
   * @param string $time
   * @return void
   */
  public function setDate(string $date): void {
    try {
      $date = Carbon::parse($date)->toDateString();
      $this->event->date = $date;
    } catch (InvalidFormatException $e) {
    };
  }

  /**
   * Render the component
   *
   * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
   */
  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();

    return view('livewire.schedule.event-create');
  }
}
