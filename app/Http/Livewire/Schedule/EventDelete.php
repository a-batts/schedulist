<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Event;
use App\Models\Subscription;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class EventDelete extends Component
{

    public $eventId;

    protected $listeners = ['setDeleteEvent' => 'setEvent'];

    public function setEvent($id){
      $this->eventId = $id;
    }

    public function deleteEvent(){
      $event = Event::where('id', $this->eventId)->where('user_id', Auth::User()->id)->firstOrFail();
      $event->delete();
      $this->emit('updateAgendaData');
      $this->emit('toastMessage', 'Event was succesfully deleted');
    }

    public function unsubEvent(){
      $event = Event::where('id', $this->eventId)->first();
      $sharedWith = explode(',', $event->shared_with);
      if (in_array(Auth::User()->id, $sharedWith))
        unset($sharedWith[array_search(Auth::User()->id, $sharedWith)]);
      $event->shared_with = implode(',', $sharedWith);
      $event->save();

      $subscriptions = Subscription::where('user_id', Auth::User()->id)->first();
      $events = explode(',', $subscriptions->events);
      if (in_array($event->id, $events))
        unset($events[array_search($event->id, $events)]);
      $subscriptions->events = implode(',', $events);
      $subscriptions->save();

      $this->emit('updateAgendaData');
      $this->emit('toastMessage', 'Successfully unsubscribed from event');
    }

    public function render(){
        return view('livewire.schedule.event-delete');
    }
}
