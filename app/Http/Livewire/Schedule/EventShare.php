<?php

namespace App\Http\Livewire\Schedule;

use App\Jobs\SendEventInvitation;

use App\Models\User;
use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class EventShare extends Component {

  /**
   * The event being shared
   *
   * @var Event
   */
  public Event $event;

  /**
   * The current user email query string
   *
   * @var string
   */
  public string $query = '';

  /**
   * The public link for the event
   *
   * @var string|null
   */
  public ?string $publicLink;

  public array $errorMessages = [];

  protected $listeners = ['setShareEvent' => 'setEvent'];

  /**
   * Validation rules
   *
   * @return array
   */
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
    $user = User::where('email', 'like', '%' . $this->query . '%')->where('id', '<>', Auth::id())->first();
    if ($user == null) {
      $this->addError('query', 'That email address does not have a Schedulist account associated with it');
      return;
    }
    $this->reset('query');

    if (EventUser::where(['user_id' => $user->id, 'event_id' => $this->event->id])->exists()) {
      $this->addError('query', 'This event has already been shared with that user');
      return;
    }

    EventUser::create(['user_id' => $user->id, 'event_id' => $this->event->id, 'accepted' => false])->save();
    //Dispatch an email to the invited user with a generated link for the event
    SendEventInvitation::dispatchSync([
      'owner' => Auth::user(),
      'eventName' => $this->event->name,
      'route' => $this->generateRoute($this->event->id, $user->id),
      'user' => $user
    ]);
  }

  /**
   * Unshare event with the specified user
   *
   * @param int $id
   * @return void
   */
  public function unshare(int $userId): void {
    EventUser::where(['event_id' => $this->event->id, 'user_id' => $userId])->delete();
    $this->event = Event::find($this->event->id);
  }

  /**
   * Select the event to be shared
   *
   * @param int $id
   * @return void
   */
  public function setEvent(int $eventId): void {
    try {
      $this->event = Event::where(['id' => $eventId, 'owner' => Auth::id()])->firstOrFail();
      $this->publicLink = $this->event->public ? $this->generateRoute($this->event->id) : null;

      $this->clearValidation();
      $this->dispatchBrowserEvent('open-share-modal');
    } catch (ModelNotFoundException) {
    }
  }

  /**
   * Make the event public and generate a link
   *
   * @return void
   */
  public function makePublic(): void {
    $this->event->public = true;
    $this->event->save();
    $this->publicLink = $this->generateRoute($this->event->id);
  }

  /**
   * Make the event private and disable the sharing link
   *
   * @return void
   */
  public function makePrivate(): void {
    $this->event->public = false;
    $this->event->save();
    $this->publicLink = null;
  }

  /**
   * Generate a link for the event
   *
   * @param int $eventId
   * @param null|int $userId
   * @return string
   */
  public function generateRoute(int $eventId, ?int $userId = null): string {
    return URL::signedRoute('share-event', ['event_id' => $eventId, 'user_id' => $userId]);
  }

  /**
   * Render the component
   *
   * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
   */
  public function render() {
    $this->errorMessages = $this->getErrorBag()->toArray();
    return view('livewire.schedule.event-share');
  }
}
