<?php

namespace App\Http\Livewire\Dashboard;

use App\Helpers\ClassScheduleHelper;
use App\Models\Classes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class DashboardCards extends Component {

  /**
   * The active class, if there is one
   *
   * @var Classes|null
   */
  public ?Classes $currentClass;

  /**
   * The next class, if there is no active class and a next class exists
   *
   * @var Classes|null
   */
  public ?Classes $nextClass;

  /**
   * Collection of the user's incomplete assignments
   *
   * @var EloquentCollection
   */
  public EloquentCollection $assignments;

  /**
   * Collection of the user's upcoming events
   *
   * @var Collection
   */
  public Collection $events;

  protected $listeners = ['refreshClasses' => 'refresh'];

  /**
   * Mount the component
   *
   * @return void
   */
  public function mount(): void {
    $this->refresh();
  }

  /**
   * Return the current class, or null if there is no current class
   *
   * @return Classes|null
   */
  public function getCurrentClass(): ?Classes {
    $scheduleHelper = new ClassScheduleHelper();
    $currentClass = $scheduleHelper->getCurrentClass(Carbon::now());

    //If there is no current class, determine the next class and return void
    if ($currentClass == null) {
      $nextClass = $scheduleHelper->getNextClass(Carbon::now());

      if (isset($nextClass)) {
        $nextClass['class']->timestring = $nextClass['start']->format('g:i A') . ' on ' . $nextClass['start']->format('D, F jS');
        $this->nextClass = $nextClass['class'];
      }
      return null;
    }

    //Add the timestring to the class object
    $currentClass['class']->timestring = $currentClass['start']->format('g:i A') . ' - ' . $currentClass['end']->format('g:i A');

    //Return just the class object
    return $currentClass['class'];
  }

  /**
   * Refresh the component
   *
   * @return void
   */
  public function refresh(): void {
    $this->currentClass = $this->getCurrentClass();

    $this->assignments = Auth::User()->assignments()->where('due', '>', Carbon::now())->where('status', 'inc')->take(8)->orderBy('due', 'asc')->get();

    $date = Carbon::now();
    $dayIso = $date->dayOfWeekIso;

    $this->events = new Collection();

    foreach (Auth::user()->events()->orderBy('end_time', 'asc')->get() as $each) {
      $eventDate = Carbon::parse($each->date);
      if ($each->reoccuring)
        $days = explode(',', (string) $each->days);

      $eventIsToday = ($eventDate->toDateString() == $date->toDateString());

      if ($each->frequency == 31)
        $repeatsToday = ($eventDate > $date && Carbon::now()->setDay($eventDate->format('j'))->between($date->copy()->startOfWeek(), $date->copy()->endOfWeek()) && in_array($dayIso, $days));
      elseif ($each->frequency != null)
        $repeatsToday = (($eventDate->diffInDays($date) % $each->frequency == 0 || $eventDate->diffInDays($date) % $each->frequency < 7 && $eventDate->diffInDays($date) % $each->frequency > -7) && in_array($dayIso, $days));
      else
        $repeatsToday = false;

      if ($eventIsToday || ($each->reoccuring && $repeatsToday)) {
        $each->timestring = Carbon::parse($each->start_time)->format('g:i A') . ' - ' . Carbon::parse($each->end_time)->format('g:i A');
        $this->events->push($each);
      }
    }
    $this->events = $this->events->take(8);
  }

  /**
   * Render the component
   *
   * @return void
   */
  public function render() {
    return view('livewire.dashboard.dashboard-cards');
  }
}
