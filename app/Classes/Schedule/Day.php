<?php

namespace App\Classes\Schedule;

use App\Helpers\ClassScheduleHelper;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Countable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class Day implements Countable
{
    /**
     * The date
     *
     * @var Carbon
     */
    private Carbon $date;

    /**
     *
     * @var array<Event>
     */
    public array $events = [];

    public function __construct(Carbon $date, array $queriedData)
    {
        $this->date = $date;

        $this->events = array_merge(
            $this->getAssignments(
                $queriedData['assignments'],
                $queriedData['classes']
            ),
            $this->getClasses($queriedData['schedule']),
            $this->getOtherEvents($queriedData['events'])
        );

        usort($this->events, function ($a, $b) {
            return $a->top <=> $b->top;
        });

        for ($i = 1; $i < count($this->events); $i++) {
            if (
                $this->events[$i]->top > $this->events[$i - 1]->top &&
                $this->events[$i]->top < $this->events[$i - 1]->bottom
            ) {
                $this->events[$i]->left = $this->events[$i - 1]->left + 140;
                $this->events[$i]->height = $this->events[$i - 1]->height + 1;
            }
        }
    }

    /**
     * Get the assignments for date
     *
     * @param Collection $data
     * @param Collection $classes
     * @return array<Event>
     */
    private function getAssignments(
        Collection $data,
        Collection $classes
    ): array {
        foreach ($data as $item) {
            $date = Carbon::parse($item->due);
            $eventTop = $date
                ->copy()
                ->subHour()
                ->subMinute();

            if ($this->date->toDateString() == $date->toDateString()) {
                $className =
                    $classes->find($item->class_id)->name ?? 'Deleted Class';
                $link = $item->link;

                $events[] = new Event(
                    $this->date,
                    $item->id,
                    'assignment',
                    $item->name,
                    route('assignmentPage') . '/' . $item->url_string,
                    'green',
                    $date,
                    null,
                    CarbonInterval::minutes($eventTop->format('i'))->hours(
                        $eventTop->format('G')
                    )->totalSeconds / Schedule::SCALE_FACTOR,
                    CarbonInterval::minutes($date->format('i'))->hours(
                        $date->format('G')
                    )->totalSeconds / Schedule::SCALE_FACTOR,
                    [
                        'className' => $className,
                        'url' => $link ?? null,
                    ]
                );
            }
        }

        return $events ?? [];
    }

    /**
     * Get the occuring classes for date
     *
     * @param Collection $data
     * @param ClassScheduleHelper $schedule
     * @return array<Event>
     */
    private function getClasses(ClassScheduleHelper $scheduleHelper): array
    {
        $data = $scheduleHelper->getDayClasses($this->date);

        foreach ($data as $item) {
            $start = $item['start'];
            $end = $item['end'];

            $events[] = new Event(
                $this->date,
                $item['class']->id,
                'class',
                $item['class']->name,
                null,
                $item['class']->color,
                $start,
                $end,
                CarbonInterval::minutes($start->format('i'))->hours(
                    $start->format('G')
                )->totalSeconds / Schedule::SCALE_FACTOR,
                CarbonInterval::minutes($end->format('i'))->hours(
                    $end->format('G')
                )->totalSeconds / Schedule::SCALE_FACTOR
            );
        }

        return $events ?? [];
    }

    /**
     * Get the other events for date
     *
     * @param Collection $data
     * @return array<Event>
     */
    private function getOtherEvents(Collection $data): array
    {
        $iso = $this->date->dayOfWeekIso;

        foreach ($data as $item) {
            $date = Carbon::parse($item->date);

            if ($item->reoccuring) {
                $days = explode(',', (string) $item->days);
            }

            //If an event's first date is before this day, break the loop to prevent it from being added
            if ($this->date < $date) {
                break;
            }

            switch ($item->frequency) {
                case null:
                    $occursToday = false;
                    break;
                case 31:
                    $occursToday =
                        $date > $this->date &&
                        Carbon::now()
                            ->setDay($date->format('j'))
                            ->between(
                                $this->date->copy()->startOfWeek(),
                                $this->date->copy()->endOfWeek()
                            ) &&
                        in_array($iso, $days);
                    break;
                default:
                    $occursToday =
                        ($date->diffInDays($this->date) % $item->frequency ==
                            0 ||
                            ($date->diffInDays($this->date) % $item->frequency <
                                7 &&
                                $date->diffInDays($this->date) %
                                    $item->frequency >
                                    -7)) &&
                        in_array($iso, $days);
                    break;
            }

            if (
                $this->date->toDateString() == $date->toDateString() ||
                ($item->reoccuring && $occursToday)
            ) {
                if (isset($item->frequency)) {
                    $frequency =
                        $item->frequency == 31
                            ? 'Every Month'
                            : sprintf('Every %s Days', $item->frequency);
                }

                $start = Carbon::parse($item->start_time);
                $end = Carbon::parse($item->end_time);

                $events[] = new Event(
                    $this->date,
                    $item->id,
                    'event',
                    $item->name,
                    null,
                    (string) $item->color ?? 'blue',
                    $start,
                    $end,
                    CarbonInterval::minutes($start->format('i'))->hours(
                        $start->format('G')
                    )->totalSeconds / Schedule::SCALE_FACTOR,
                    CarbonInterval::minutes($end->format('i'))->hours(
                        $end->format('G')
                    )->totalSeconds / Schedule::SCALE_FACTOR,
                    [
                        'category' => $item->category,
                        'repeat' => 'Repeats ' . ($frequency ?? 'Never'),
                        'isOwner' => Auth::id() == $item->owner,
                    ]
                );
            }
        }

        return $events ?? [];
    }

    /**
     * Returns the count of events for the day
     *
     * @return integer
     */
    public function count(): int
    {
        return count($this->events);
    }

    /**
     * Return the event's date
     *
     * @return Carbon event date
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * Get the array representation of the day's events
     *
     * @return array
     */
    public function toArray(): array
    {
        $arr = [];

        foreach ($this->events as $event) {
            $arr[] = $event->toArray();
        }
        return $arr;
    }
}
