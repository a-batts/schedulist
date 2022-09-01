<?php

namespace App\Http\Livewire\Dashboard;

use App\Helpers\ClassScheduleHelper;
use App\Models\Classes;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Livewire\Component;

class DashboardCards extends Component {
  public $activeClass;

  public $nextClass;

  public $assignments;

  public $events;

  protected $listeners = ['refreshClasses' => 'refresh'];

  public function mount() {
    $this->refresh();
  }

  public function getActiveClass() {
    $scheduleHelper = new ClassScheduleHelper();
    $currentClass = $scheduleHelper->getCurrentClass(Carbon::now());

    if ($currentClass == null) {
      $nextClass = $scheduleHelper->getNextClass(Carbon::now());

      if (isset($nextClass)) {
        $nextClass['class']->timestring = $nextClass['start']->format('g:i A') . ' on ' . $nextClass['start']->format('D, F jS');
        $this->nextClass = $nextClass['class'];
      }
      return;
    }

    //Add the timestring to the class object
    $currentClass['class']->timestring = $currentClass['start']->format('g:i A') . ' - ' . $currentClass['end']->format('g:i A');

    //Return just the class object
    return $currentClass['class'];
  }

  public function refresh() {
    $this->activeClass = $this->getActiveClass();
    $this->assignments = Auth::user()->assignments()->where('due', '>', Carbon::now())->where('status', 'inc')->take(8)->orderBy('due', 'asc')->get();
    foreach ($this->assignments as $assignment)
      $assignment->due = Carbon::parse($assignment->due)->format('M j, g:i A');

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

  public function render() {
    return view('livewire.dashboard.dashboard-cards');
  }
}
