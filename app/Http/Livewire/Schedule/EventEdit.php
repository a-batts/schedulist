<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Event;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

use Livewire\Component;

class EventEdit extends Component
{
    public Event $event;

    public array $categories = ['Club Meeting', 'Final', 'Game', 'Job Shift', 'Quiz', 'Practice/Rehersal', 'Test', 'Volunteer Work', 'Other'];

    public array $frequencies = ['Day', 'Week', 'Two Weeks', 'Month'];

    public array $days = ['M', 'Tu', 'W', 'Th', 'F', 'Sa', 'Su'];

    public array $errorMessages = [];

    public $dayOfWeekValue;

    protected $listeners = ['setStartTime', 'setEndTime', 'setEventDate' => 'setDate', 'setEditEvent' => 'setEvent'];

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

    public function edit(){
      $this->validate();

      $explode = [];
      foreach($this->event->days as $day)
        array_push($explode, array_search($day, $this->days) + 1);
      $this->event->days = implode(',', $explode);

      $event = $this->event;

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

      if ($event->owner == Auth::user()->id){
        $this->emit('updateAgendaData');
        $this->emit('toastMessage', 'Event was successfully updated');
        $event->save();
      }
      $this->dispatchBrowserEvent('close-dialog');

    }

    public function setCategory($category){
      if (in_array($category, $this->categories)){
        $this->event->category = $category;
        $this->clearValidation('event.category');
      }
      else
        $this->addError('event.category', 'You\'ve selected an invalid category');
    }

    public function getStartTime(){
      return $this->event->start_time;
    }

    public function setStartTime($time){
      $this->event->start_time = $time;
    }

    public function getEndTime(){
      return $this->event->end_time;
    }

    public function setEndTime($time){
      $this->event->end_time = $time;
    }

    public function getDate(){
      return $this->event->date;
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

    public function getReoccuring(){
      return (bool) $this->event->reoccuring;
    }

    public function getFrequency(){
      return $this->event->frequency;
    }

    public function getDays(){
      $days = explode(',', $this->event->days);
      foreach($days as $index => $value)
        $days[$index] = $this->days[$value - 1];
      $days = implode(',', $days);
      return $days;
    }

    public function setEvent($id){
      $event = Event::find($id);
      $this->clearValidation();
      $this->dayOfWeekValue = $this->getDayOfWeekValue();
      switch ($event->frequency) {
        case 1:
          $event->frequency = 'Day';
          break;
        case 7:
          $event->frequency = 'Week';
          break;
        case 14:
          $event->frequency = 'Two Weeks';
          break;
        case 31:
          $event->frequency = 'Month';
          break;
      }
      $event->name = Crypt::decryptString($event->name);

      if ($event->owner == Auth::User()->id)
        $this->event = $event;
      $this->dispatchBrowserEvent('update-content');
    }

    public function render(){
        $this->errorMessages = $this->getErrorBag()->toArray();

        return view('livewire.schedule.event-edit');
    }
}
