<?php

namespace App\Http\Livewire\Schedule;

use App\Models\User;
use App\Models\Event;
use App\Models\Subscription;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class EventInvite extends Component
{
    public Event $event;

    public Carbon $eventDate;

    public $eventTimes;

    protected $eventOwner;

    public bool $invalid = false;

    public bool $showingInviteMenu = false;

    public function mount($sharedEvent, $invalidEvent){
      if (isset($sharedEvent)){
        $subscribed = Subscription::where('user_id', Auth::User()->id)->first();
        $subscribedEvents = explode(',', $subscribed->events);
        if ($invalidEvent)
          $this->invalid = true;
        elseif ($sharedEvent->user_id != Auth::User()->id && ! in_array($sharedEvent->id, $subscribedEvents)){
          $this->event = $sharedEvent;
          $this->eventDate = Carbon::parse($this->event->date);
          $this->eventTimes =  Carbon::parse($this->event->start_time)->format('g:i A').' - '.Carbon::parse($this->event->end_time)->format('g:i A');
          $this->eventOwner = User::find($this->event->user_id);
          $this->showingInviteMenu = true;
        }
      }
    }

    public function addEvent(){
      $event = $this->event;
      $subscribed = Subscription::where('user_id', Auth::User()->id)->first();
      $subscribedEvents = explode(',', $subscribed->events);
      if (! in_array($event->id, $subscribedEvents))
        array_push($subscribedEvents, $event->id);
      $subscribed->events = implode(',', $subscribedEvents);
      $subscribed->save();
      $this->dispatchBrowserEvent('close-invite-menu');
      $this->emit('updateAgendaData');
    }

    public function render(){
      return view('livewire.schedule.event-invite')->with('eventOwner', $this->eventOwner);
    }
}
