<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Event;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;

use Livewire\Component;

class EventCreate extends Component
{
    public Event $event;

    public array $categories = ['Club Meeting', 'Final', 'Game', 'Job Shift', 'Quiz', 'Practice/Rehersal', 'Test', 'Volunteer Work', 'Other'];

    public array $frequencies = ['Day', 'Week', 'Two Weeks', 'Month'];

    public array $days = ['M', 'Tu', 'W', 'Th', 'F', 'Sa', 'Su'];

    public array $errorMessages = [];

    public $dayOfWeekValue;

    protected $listeners = ['setStartTime', 'setEndTime', 'setEventDate' => 'setDate'];

    function rules(){
      return [
        'event.name' => 'required',
        'event.category' => 'required',
        'event.start_time' => 'required',
        'event.end_time' => 'required',
        'event.date' => 'required',
        'event.reoccuring' => 'required',
        'event.frequency' => Rule::requiredIf($this->event->reoccuring == true),
        'event.days' => Rule::requiredIf($this->event->reoccuring == true && ($this->event->frequency == 'Week' || $this->event->frequency == 'Two Weeks')),
      ];
    }

    public function mount(){
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

    public function create(){
      $this->resetValidation();
      $this->validate();

      $explode = [];
      foreach($this->event->days as $day)
        array_push($explode, array_search($day, $this->days) + 1);
      $this->event->days = implode(',', $explode);

      $event = $this->event;
      $event->user_id = Auth::User()->id;

      $event->save();
      $this->emit('updateAgendaData');
      $this->dispatchBrowserEvent('close-dialog');
      $this->emit('toastMessage', 'Event was successfully created');
    }

    public function setCategory($category){
      if (in_array($category, $this->categories)){
        $this->event->category = $category;
        $this->clearValidation('event.category');
      }
      else
        $this->addError('event.category', 'You\'ve selected an invalid category');
    }

    public function setStartTime($time){
      $this->event->start_time = $time;
    }

    public function setEndTime($time){
      $this->event->end_time = $time;
    }

    public function setDate($date){
      $oldDay = $this->getDayOfWeekValue();
      $this->event->date = $date;
      $this->dispatchBrowserEvent('toggle-day', [
        'oldDay' => $oldDay,
        'newDay' => $this->getDayOfWeekValue(),
      ]);
    }

    public function getDayOfWeekValue(){
      return (string) $this->days[Carbon::parse($this->event->date)->dayOfWeekIso - 1];
    }

    public function render(){
      $this->errorMessages = $this->getErrorBag()->toArray();

      return view('livewire.schedule.event-create');
    }
}
