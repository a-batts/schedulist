<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Event;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use App\Models\EventUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventDelete extends Component
{
    /**
     * The event id to delete
     *
     * @var integer
     */
    public int $eventId;

    protected $listeners = ['setDeleteEvent' => 'setEvent'];

    /**
     * Select the event to delete
     *
     * @param integer $id
     * @return void
     */
    public function setEvent(int $id): void
    {
        $this->eventId = $id;
    }

    /**
     * Delete the selected event
     *
     * @return void
     */
    public function deleteEvent(): void
    {
        try {
            $event = Event::where('id', $this->eventId)
                ->where('owner', Auth::id())
                ->firstOrFail();
            $event->delete();
            $this->emit('updateAgendaData');
            $this->emit('toastMessage', 'Event was successfully deleted');
        } catch (ModelNotFoundException) {
            $this->emit('toastMessage', 'Couldn\'t delete event');
        }
    }

    /**
     * "Unsubscribe" from the selected event
     *
     * @return void
     */
    public function unsubEvent(): void
    {
        $subscription = EventUser::where([
            'user_id' => Auth::id(),
            'event_id' => $this->eventId,
        ]);
        $subscription->delete();

        $this->emit('updateAgendaData');
        $this->emit('toastMessage', 'Successfully unsubscribed from event');
    }

    /**
     * Render the component
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.schedule.event-delete');
    }
}
