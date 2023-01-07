<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Event;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use App\Models\EventUser;

class EventDelete extends Component
{
    public $eventId;

    protected $listeners = ['setDeleteEvent' => 'setEvent'];

    public function setEvent($id)
    {
        $this->eventId = $id;
    }

    public function deleteEvent()
    {
        $event = Event::where('id', $this->eventId)
            ->where('owner', Auth::id())
            ->firstOrFail();
        $event->delete();
        $this->emit('updateAgendaData');
        $this->emit('toastMessage', 'Event was succesfully deleted');
    }

    public function unsubEvent()
    {
        $subscription = EventUser::where([
            'user_id' => Auth::id(),
            'event_id' => $this->eventId,
        ]);
        $subscription->delete();

        $this->emit('updateAgendaData');
        $this->emit('toastMessage', 'Successfully unsubscribed from event');
    }

    public function render()
    {
        return view('livewire.schedule.event-delete');
    }
}
