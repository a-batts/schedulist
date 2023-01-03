<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Event;
use App\Models\EventUser;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class EventInvite extends Component {

  /**
   * The event being shared
   *
   * @var Event
   */
  public Event $event;

  /**
   * The invitation to the event
   *
   * @var EventUser|null
   */
  public ?EventUser $invite;

  /**
   * Whether or not the event is invalid/ cannot be added by this specific user
   *
   * @var boolean
   */
  public bool $invalid = true;

  /**
   * Mount the component
   *
   * @param Event|null $sharedEvent
   * @return void
   */
  public function mount($sharedEvent = null): void {
    if (isset($sharedEvent)) {
      $this->invalid = false;

      $invite = EventUser::where(['event_id' => $sharedEvent->id, 'user_id' => Auth::id()])->first();
      if ($invite == null || $invite->accepted)
        $this->invalid = true;
      else
        $this->event = $sharedEvent;

      $this->invite = $invite;
    }
  }

  /**
   * Accept the invitation and add the event to the user's calendar
   *
   * @return void
   */
  public function addEvent(): void {
    $this->invite->accepted = true;
    $this->invite->save();

    $this->dispatchBrowserEvent('close-invite-menu');
    $this->emit('updateAgendaData');
  }

  /**
   * Render the component
   *
   * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
   */
  public function render() {
    return view('livewire.schedule.event-invite');
  }
}
