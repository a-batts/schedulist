<?php

namespace App\Http\Livewire\Dashboard;

use App\Enums\Assignment\AssignmentStatus;
use App\Helpers\ClassScheduleHelper;
use App\Models\Classes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class DashboardCards extends Component
{
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

    /**
     * Array of possible phrases for when a user does not have any events
     *
     * @var array
     */
    private array $noEventPhrases = [
        'No events scheduled. Movie night?',
        'No more events today! Time to hit the town.',
        'No events coming up today. Nap time!',
        'Nothing scheduled tonight. Feel free to catch up on work.',
    ];

    protected $listeners = [
        'refreshClasses' => 'refresh',
        'updateCurrentClass',
        'deleteClass',
    ];

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount(): void
    {
        $this->refresh();
    }

    /**
     * Update the current class
     *
     * @return void
     */
    public function updateCurrentClass(): void
    {
        $this->currentClass = $this->getCurrentClass();
    }

    /**
     * Refresh the component
     *
     * @return void
     */
    public function refresh(): void
    {
        $this->currentClass = $this->getCurrentClass();
        $this->assignments = Auth::user()
            ->assignments()
            ->where('due', '>', Carbon::now())
            ->where('status', AssignmentStatus::Incomplete->value)
            ->take(8)
            ->orderBy('due', 'asc')
            ->get();
        $this->events = $this->getEvents()->take(8);
    }

    /**
     * Return the current class, or null if there is no current class
     *
     * @return Classes|null
     */
    public function getCurrentClass(): ?Classes
    {
        $scheduleHelper = new ClassScheduleHelper();

        $currentClass = $scheduleHelper->getCurrentClass(Carbon::now());

        //If there is no current class, determine the next class and return null
        if ($currentClass == null) {
            $nextClass = $scheduleHelper->getNextClass(Carbon::now());

            if (isset($nextClass) && count($nextClass) != 0) {
                $nextClass['class']->timestring =
                    $nextClass['start']->format('g:i A') .
                    ' on ' .
                    $nextClass['start']->format('D, F jS');
                $this->nextClass = $nextClass['class'];
            }
            return null;
        }

        //Add the timestring to the class object
        $currentClass['class']->timestring =
            $currentClass['start']->format('g:i A') .
            ' - ' .
            $currentClass['end']->format('g:i A');

        //Return just the class object
        return $currentClass['class'];
    }

    /**
     * Get the user's upcoming events
     *
     * @return Collection
     */
    public function getEvents(): Collection
    {
        $date = Carbon::now();
        $dayIso = $date->dayOfWeekIso;

        $events = new Collection();

        foreach (
            Auth::user()
                ->events()
                ->orderBy('end_time', 'asc')
                ->get()
            as $event
        ) {
            $eventDate = Carbon::parse($event->date);

            if ($event->reoccuring) {
                $days = explode(',', (string) $event->days);
            }

            if ($event->frequency == null) {
                $repeatsToday = false;
            } else {
                $repeatsToday =
                    $event->frequency == 31
                        ? $eventDate > $date &&
                            Carbon::now()
                                ->setDay($eventDate->format('j'))
                                ->between(
                                    $date->copy()->startOfWeek(),
                                    $date->copy()->endOfWeek()
                                ) &&
                            in_array($dayIso, $days)
                        : ($eventDate->diffInDays($date) % $event->frequency ==
                                0 ||
                                ($eventDate->diffInDays($date) %
                                    $event->frequency <
                                    7 &&
                                    $eventDate->diffInDays($date) %
                                        $event->frequency >
                                        -7)) &&
                            in_array($dayIso, $days);
            }

            if (
                $eventDate->toDateString() == $date->toDateString() ||
                ($event->reoccuring && $repeatsToday)
            ) {
                $event->timestring =
                    Carbon::parse($event->start_time)->format('g:i A') .
                    ' - ' .
                    Carbon::parse($event->end_time)->format('g:i A');
                $events->push($event);
            }
        }

        return $events;
    }

    public function getEventPhrase(): string
    {
        return $this->noEventPhrases[array_rand($this->noEventPhrases)];
    }

    /**
     * Delete class with the specified id - needed to prevent 404 errors
     *
     * @param integer $id
     * @return void
     */
    public function deleteClass(int $id): void
    {
        try {
            $this->currentClass = null;
            $this->nextClass = null;
            $class = Auth::user()
                ->classes()
                ->firstOrFail($id);
            $class->times()->delete();
            $class->delete();

            $this->emit('toastMessage', 'Class successfully deleted');
            $this->emit('refreshClasses');
        } catch (ModelNotFoundException) {
            $this->emit('toastMessage', 'Unable to delete class');
        }
    }

    /**
     * Render the component
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('livewire.dashboard.dashboard-cards');
    }
}
