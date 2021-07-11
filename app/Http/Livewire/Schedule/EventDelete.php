<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Event;

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
      //Unsubscribe from event if not owned
      $event->delete();
      $this->emit('updateAgendaData');
      $this->emit('toastMessage', 'Event was succesfully deleted');
    }

    public function render(){
        return view('livewire.schedule.event-delete');
    }
}
