<?php

namespace App\Http\Livewire\Schedule;

use App\Models\User;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\Subscription;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class EventInvite extends Component {
  public Event $event;

  public Carbon $eventDate;

  public $eventTimes;

  protected $eventOwner;

  public bool $invalid = false;

  public $invite;

  public bool $showingInviteMenu = false;

  public function mount($sharedEvent, $invalidEvent) {
    if (isset($sharedEvent)) {
      $this->invite = EventUser::where(['event_id' => $sharedEvent->id, 'user_id' => Auth::id()])->first();
      if ($this->invite == null || $this->invite->accepted || $invalidEvent)
        $this->invalid = true;
      else {
        $this->event = $sharedEvent;
        $this->eventDate = Carbon::parse($this->event->date);
        $this->eventTimes =  Carbon::parse($this->event->start_time)->format('g:i A') . ' - ' . Carbon::parse($this->event->end_time)->format('g:i A');
        $this->eventOwner = User::find($this->event->owner);
        $this->showingInviteMenu = true;
      }
    }
  }

  public function addEvent() {
    $invite = $this->invite;
    $invite->accepted = true;
    $invite->save();

    $this->dispatchBrowserEvent('close-invite-menu');
    $this->emit('updateAgendaData');
  }

  public function render() {
    return view('livewire.schedule.event-invite')->with('eventOwner', $this->eventOwner);
  }
}
