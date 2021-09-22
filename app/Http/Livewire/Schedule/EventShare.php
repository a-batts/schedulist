<?php

namespace App\Http\Livewire\Schedule;

use App\Jobs\SendEventInvitation;

use App\Models\User;
use App\Models\Event;
use App\Models\EventUser;
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
      if ($this->query == Auth::user()->email){
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

      if (! EventUser::where(['user_id' => $user->id, 'event_id' => $this->event->id])->exists()){
        $eventUser = new EventUser(['user_id' => $user->id, 'event_id' => $this->event->id, 'accepted' => false]);
        $eventUser->save();
        $this->sharedWith = $this->event->users()->where('user_id', '!=', Auth::user()->id)->get();
      }
      else{
        $this->addError('query', 'This event has already been shared with that user');
        return;
      }
      

      //send email to user with generated link
      $route = $this->generateRoute($this->event->id, $user->id);
      $details = ['owner' => Auth::user(), 'eventName' => $this->event->name, 'route' => $route, 'email' => $user->email];
      SendEventInvitation::dispatchNow($details);
    }

    public function unshare($id){
      $sharedEvent = EventUser::where(['user_id' => $id, 'event_id' => $this->event->id])->first();
      $sharedEvent->delete();
      $this->sharedWith = $this->event->users()->where('user_id', '!=', Auth::user()->id)->get();
    }

    /**
     * Set event modal
     * @param int $id
     */
    public function setEvent($id){
      $this->event = Event::where('id', $id)->where('owner', Auth::User()->id)->firstOrFail();
      $this->clearValidation();
      $this->dispatchBrowserEvent('open-share-modal');
      if($this->event->public)
        $this->publicLink = $this->generateRoute($this->event->id);
      else
        $this->publicLink = null;
      $this->sharedWith = $this->event->users()->where('user_id', '!=', Auth::user()->id)->get();
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
