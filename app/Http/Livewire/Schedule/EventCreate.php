<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Event;
use App\Models\EventUser;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

use Livewire\Component;

class EventCreate extends Component {

  const DAYS = ['M', 'Tu', 'W', 'Th', 'F', 'Sa', 'Su'];

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

  public array $errorMessages = [];

  public $dayOfWeekValue;

  function rules() {
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

  public function mount() {
    $this->event = new Event();
    $this->event->date = Carbon::now()->toDateString();
    $this->event->start_time = Carbon::now()->format('H:i');
    $this->event->end_time = '23:59';
    $this->event->reoccuring = false;
    $this->dayOfWeekValue = $this->getDayOfWeekValue();
  }

  /**
   * Validate updated properties
   * @param  mixed $propertyName
   * @return void
   */
  public function updated($propertyName) {
    $this->validateOnly($propertyName);
  }

  /**
   * Create the new event
   *
   * @return void
   */
  public function create() {
    $this->resetValidation();
    $this->validate();

    $explode = [];
    foreach ($this->event->days as $day)
      array_push($explode, array_search($day, Self::DAYS) + 1);
    $this->event->days = implode(',', $explode);

    $event = $this->event;
    $event->owner = Auth::user()->id;

    if ($event->frequency != null) {
      switch ($event->frequency) {
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
      }
    }

    $event->color = 'blue';

    $this->dispatchBrowserEvent('close-dialog');

    $event->name = Crypt::encryptString($event->name);

    $event->save();
    $this->emit('updateAgendaData');
    $this->emit('toastMessage', 'Event was successfully created');

    $eventUser = new EventUser(['user_id' => Auth::user()->id, 'event_id' => $event->id, 'accepted' => true]);
    $eventUser->save();
  }

  public function getDayOfWeekValue() {
    return (string) Self::DAYS[Carbon::parse($this->event->date)->dayOfWeekIso - 1];
  }


  public function setCategory($category) {
    if (in_array($category, $this->categories)) {
      $this->event->category = $category;
      $this->clearValidation('event.category');
    } else
      $this->addError('event.category', 'You\'ve selected an invalid category');
  }

  /**
   * Set the event's start time
   *
   * @param [type] $time
   * @return void
   */
  public function setStartTime($time) {
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
   * @param [type] $time
   * @return void
   */
  public function setEndTime($time) {
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
   * @param [type] $time
   * @return void
   */
  public function setDate($date) {
    $oldDay = $this->getDayOfWeekValue();
    $this->event->date = $date;
    $this->dispatchBrowserEvent('toggle-day', [
      'oldDay' => $oldDay,
      'newDay' => $this->getDayOfWeekValue(),
    ]);
  }

  /**
   * Render the component
   *
   * @return void
   */
  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();

    return view('livewire.schedule.event-create');
  }
}
