<?php

namespace App\Http\Livewire\Schedule;

use App\Jobs\SendEventInvitation;

use App\Models\User;
use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class EventShare extends Component {
  public Event $event;

  /**
   * The current user email query string
   *
   * @var string
   */
  public string $query;

  /**
   * Collection of users the event is shared with
   *
   * @var Illuminate\Support\Collection
   */
  public Collection $sharedWith;

  /**
   * The public link for the event
   *
   * @var string|null
   */
  public ?string $publicLink;

  public array $errorMessages = [];

  protected $listeners = ['setShareEvent' => 'setEvent'];

  function rules(): array {
    return [
      'query' => 'nullable',
    ];
  }

  /**
   * Mount the component
   *
   * @return void
   */
  public function mount(): void {
    $this->event = new Event();
    $this->query = '';
    $this->sharedWith = collect([]);
  }

  /**
   * Share the event with the selected email and dispactch an email notification
   *
   * @return void
   */
  public function share(): void {
    $this->clearValidation();

    if ($this->query == Auth::user()->email) {
      $this->addError('query', 'You are already the owner of this event');
      return;
    }
    $user = User::where('email', 'like', '%' . $this->query . '%')->where('id', '<>', Auth::User()->id)->first();
    if ($user == null) {
      $this->addError('query', 'That email address does not have a Schedulist account associated with it');
      return;
    }
    $this->query = '';

    if (!EventUser::where(['user_id' => $user->id, 'event_id' => $this->event->id])->exists()) {
      $eventUser = new EventUser(['user_id' => $user->id, 'event_id' => $this->event->id, 'accepted' => false]);
      $eventUser->save();
      $this->sharedWith = $this->event->users()->where('user_id', '!=', Auth::user()->id)->get();
    } else {
      $this->addError('query', 'This event has already been shared with that user');
      return;
    }

    //Dispatch an email to the invited user with a generated link for the event
    $route = $this->generateRoute($this->event->id, $user->id);
    $details = ['owner' => Auth::user(), 'eventName' => $this->event->name, 'route' => $route, 'email' => $user->email];
    SendEventInvitation::dispatchSync($details);
  }

  public function unshare($id) {
    $sharedEvent = EventUser::where(['user_id' => $id, 'event_id' => $this->event->id])->first();
    $sharedEvent->delete();
    $this->sharedWith = $this->event->users()->where('user_id', '!=', Auth::user()->id)->get();
  }

  /**
   * Get the sharing data for a specified event
   *
   * @param int $id
   * @return void
   */
  public function setEvent($id): void {
    $this->event = Event::where('id', $id)->where('owner', Auth::User()->id)->firstOrFail();
    $this->clearValidation();
    $this->dispatchBrowserEvent('open-share-modal');
    if ($this->event->public)
      $this->publicLink = $this->generateRoute($this->event->id);
    else
      $this->publicLink = null;
    $this->sharedWith = $this->event->users()->where('user_id', '!=', Auth::user()->id)->get();
  }

  /**
   * Make the event public and generate a link
   *
   * @return void
   */
  public function makePublic(): void {
    $this->event->public = true;
    $this->publicLink = $this->generateRoute($this->event->id);
    $this->event->save();
  }

  /**
   * Make the event private and disable the sharing link
   *
   * @return void
   */
  public function makePrivate(): void {
    $this->event->public = false;
    $this->publicLink = null;
    $this->event->save();
  }

  /**
   * Generate a link for the event
   *
   * @param int $id
   * @param User|null $user
   * @return string
   */
  public function generateRoute($id, $user = null): string {
    return URL::signedRoute('share-event', ['user' => $user, 'id' => $id]);
  }

  /**
   * Render the component
   *
   * @return void
   */
  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();

    return view('livewire.schedule.event-share');
  }
}
