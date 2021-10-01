<?php

namespace App\Http\Livewire\Dashboard;

use App\Helpers\ClassScheduleHelper;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Livewire\Component;

class DashboardCards extends Component {
  public $activeClass;

  public $assignments;

  public $events;

  public $nextClass;

  protected $listeners = ['refreshClasses' => 'refresh'];

  public function mount() {
    $this->refresh();
  }

  public function formatTime($time) {
    if (strlen($time) == 3)
      $first = substr($time, 0, 1);
    else
      $first = '' . substr($time, 0, 2);
    $second = '' . substr($time, -2);
    if ($second == null)
      $second = '00';
    if ($first > 12) {
      $first -= 12;
      $second .= 'PM';
    } else if ($first == 0) {
      $first = 12;
      $second .= 'AM';
    } else
      $second .= 'AM';
    return $first . ':' . $second;
  }

  public function getActiveClass() {
    $scheduleHelper = new ClassScheduleHelper(Carbon::now());
    $activeClass = $scheduleHelper->getActiveClass();
    if ($activeClass == null) {
      $next =  $scheduleHelper->getNextClass(Carbon::now());
      if ($next != null) {
        $this->nextClass = $next['class'];
        $nextDay = $next['day'];
        $this->nextClass->timestring = $this->formatTime($this->nextClass->startTime) . ' on ' . $nextDay;
      }
      return;
    }
    $activeClass->teacher = Crypt::decryptString($activeClass->teacher);
    if (isset($activeClass->class_location)) $activeClass->class_location = Crypt::decryptString($activeClass->class_location);
    $activeClass->timestring = $this->formatTime($activeClass->startTime) . ' - ' . $this->formatTime($activeClass->endTime);

    return $activeClass;
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
      else
        $repeatsToday = (($eventDate->diffInDays($date) % $each->frequency == 0 || $eventDate->diffInDays($date) % $each->frequency < 7 && $eventDate->diffInDays($date) % $each->frequency > -7) && in_array($dayIso, $days));

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
