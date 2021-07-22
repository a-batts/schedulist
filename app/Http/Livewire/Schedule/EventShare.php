<?php

namespace App\Http\Livewire\Schedule;

use App\Jobs\SendEventInvitation;

use App\Models\User;
use App\Models\Event;
use App\Models\Subscription;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class EventShare extends Component
{
    public Event $event;

    public $query;

    public $sharedWith;

    public $publicLink;

    public array $errorMessages = [];

    protected $listeners = ['setShareEvent' => 'setEvent'];

    function rules(){
      return [
        'query' => 'nullable',
      ];
    }

    public function mount(){
      $this->event = new Event();
      $this->query = '';
      $this->sharedWith = collect([]);
    }

    public function share(){
      if ($this->query == Auth::User()->email){
        $this->clearValidation();
        $this->addError('query', 'You are already the owner of this event');
        return;
      }
      $user = User::where('email', 'like', '%' . $this->query . '%')->where('id', '<>', Auth::User()->id)->first();
      if ($user == null){
        $this->clearValidation();
        $this->addError('query', 'That email address does not have a Schedulist account associated with it');
        return;
      }
      $this->query = '';
      $sharedWith = explode(',', $this->event->shared_with);
      if (! in_array($user->id, $sharedWith))
        array_push($sharedWith, $user->id);
      $this->event->shared_with = implode(',', $sharedWith);
      $this->event->save();
      $this->sharedWith = User::whereIn('id', explode(',', $this->event->shared_with))->get();

      //send email to user with generated link
      $route = $this->generateRoute($this->event->id, $user->id);
      $details = ['owner' => Auth::User(), 'eventName' => $this->event->name, 'route' => $route, 'email' => $user->email];
      SendEventInvitation::dispatchNow($details);
    }

    public function unshare($id){
      $sharedWith = explode(',', $this->event->shared_with);
      if (in_array($id, $sharedWith))
        unset($sharedWith[array_search($id, $sharedWith)]);
      $this->event->shared_with = implode(',', $sharedWith);
      $this->event->save();
      $subscribeList = Subscription::where('user_id', $id)->first();
      if ($subscribeList != null){
        $subscribedEvents = explode(',', $subscribeList->events);
        if (in_array($this->event->id, $subscribedEvents))
          unset($subscribedEvents[array_search($this->event->id, $subscribedEvents)]);
        $subscribeList->events = implode(',', $subscribedEvents);
        $subscribeList->save();
      }
      $this->sharedWith = User::whereIn('id', explode(',', $this->event->shared_with))->get();
    }

    /**
     * Set event modal
     * @param int $id
     */
    public function setEvent($id){
      $this->event = Event::where('id', $id)->where('user_id', Auth::User()->id)->firstOrFail();
      $this->clearValidation();
      $this->dispatchBrowserEvent('open-share-modal');
      if($this->event->public)
        $this->publicLink = $this->generateRoute($this->event->id);
      else
        $this->publicLink = null;
      $this->sharedWith = User::whereIn('id', explode(',', $this->event->shared_with))->get();

    }

    public function makePublic(){
      $this->event->public = true;
      $this->publicLink = $this->generateRoute($this->event->id);
      $this->event->save();
    }

    public function makePrivate(){
      $this->event->public = false;
      $this->publicLink = null;
      $this->event->save();
    }

    public function generateRoute($id, $user = null){
      return URL::signedRoute('share-event', ['user' => $user, 'id' => $id]);
    }

    public function render(){
      $this->errorMessages = $this->getErrorBag()->toArray();

      return view('livewire.schedule.event-share');
    }
}
