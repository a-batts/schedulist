<?php

namespace App\Classes\Schedule;

use App\Enums\EventFrequency;
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

    private const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    public function __construct(Carbon $date, array $queriedData)
    {
        $this->date = $date->startOfDay();

        $items = array_merge(
            $this->getAssignments(
                $queriedData['assignments'],
                $queriedData['classes']
            ),
            $this->getClasses($queriedData['schedule']),
            $this->getOtherEvents($queriedData['events'])
        );

        usort($items, function ($a, $b) {
            return $a->top <=> $b->top;
        });

        $columns = [];
        foreach ($items as $item) {
            $isInserted = false;
            for ($i = 0; $i < count($columns); $i++) {
                if (
                    $item->top > $columns[$i][count($columns[$i]) - 1]->bottom
                ) {
                    $columns[$i][] = $item;
                    $isInserted = true;
                    break;
                }
            }
            if (!$isInserted) {
                $columns[] = [$item];
            }
        }

        if (count($columns) > 0) {
            $splits = floor(100 / count($columns));
        }

        foreach ($columns as $index => $column) {
            foreach ($column as $item) {
                $item->width = $splits;
                $item->left = $splits * $index;
                $this->events[] = $item;
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
        $events = [];

        foreach ($data as $item) {
            $date = Carbon::parse($item->due);
            $eventTop = $date
                ->copy()
                ->subHour()
                ->subMinute();

            if ($this->date->toDateString() == $date->toDateString()) {
                $event = new Event(
                    date: $this->date,
                    id: $item->id,
                    type: 'assignment',
                    name: $item->name,
                    link: route('assignmentPage') . '/' . $item->url_string,
                    color: 'green',
                    start: $date,
                    data: [
                        'className' =>
                            $classes->find($item->class_id)->name ??
                            'Deleted Class',
                        'url' => $item->link ?? null,
                        'location' => $item->location ?? '',
                    ]
                );
                $events[] = $event
                    ->setTop(
                        CarbonInterval::minutes($eventTop->format('i'))->hours(
                            $eventTop->format('G')
                        )->totalSeconds / Schedule::SCALE_FACTOR
                    )
                    ->setBottom(
                        CarbonInterval::minutes($date->format('i'))->hours(
                            $date->format('G')
                        )->totalSeconds / Schedule::SCALE_FACTOR
                    );
            }
        }

        return $events;
    }

    /**
     * Get the occurring classes for date
     *
     * @param Collection $data
     * @param ClassScheduleHelper $schedule
     * @return array<Event>
     */
    private function getClasses(ClassScheduleHelper $scheduleHelper): array
    {
        $events = [];

        $data = $scheduleHelper->getDayClasses($this->date);

        foreach ($data as $item) {
            $start = $item['start'];
            $end = $item['end'];

            $events[] = new Event(
                date: $this->date,
                id: $item['class']->id,
                type: 'class',
                name: $item['class']->name,
                color: $item['class']->color,
                start: $start,
                end: $end,
                data: [
                    'location' => $item['class']->location,
                ]
            );
        }

        return $events;
    }

    /**
     * Get the other events for date
     *
     * @param Collection $items
     * @return array<Event>
     */
    private function getOtherEvents(Collection $items): array
    {
        $events = [];

        foreach ($items as $item) {
            if (
                $this->date < $item->date ||
                ($item->end_date != null && $this->date > $item->end_date)
            ) {
                continue;
            }
            if (
                $this->eventOccursToday(
                    date: $this->date,
                    eventDate: $item->date,
                    frequency: $item->frequency,
                    interval: $item->interval,
                    days: $item->days
                )
            ) {
                $start = Carbon::parse($item->start_time);
                $end = Carbon::parse($item->end_time);

                $frequency = match ($item->frequency) {
                    EventFrequency::Never => null,
                    EventFrequency::Daily => $item->interval == 1
                        ? 'day'
                        : $item->interval . ' days',
                    EventFrequency::Weekly => ($item->interval == 1
                        ? 'week '
                        : $item->interval . ' weeks ') .
                        'on ' .
                        implode(
                            ', ',
                            array_map(
                                fn($day) => static::DAYS[$day],
                                $item->days
                            )
                        ),
                    EventFrequency::Monthly => ($item->interval == 1
                        ? 'month '
                        : $item->interval . 'months ') .
                        'on the ' .
                        $item->date->format('jS') .
                        ' day',
                    EventFrequency::Yearly => ($item->interval == 1
                        ? 'year '
                        : $item->interval . 'years ') .
                        'on ' .
                        $item->date->format('F jS'),
                };

                $events[] = new Event(
                    date: $this->date,
                    id: $item->id,
                    type: $item->isOwner(Auth::user())
                        ? 'event'
                        : 'shared-event',
                    name: $item->name,
                    color: (string) $item->color ?? 'blue',
                    start: $start,
                    end: $end,
                    data: [
                        'category' => $item->category->formattedName(),
                        'repeat' =>
                            'Repeats ' . ("every $frequency" ?? 'never'),
                        'location' => $item->location,
                    ]
                );
            }
        }

        return $events;
    }

    /**
     * Determine if an event occurs on a day or not
     *
     * @param Carbon $date
     * @param EventFrequency $frequency
     * @param integer $interval
     * @param array $days
     * @return boolean
     */
    public static function eventOccursToday(
        Carbon $date,
        Carbon $eventDate,
        EventFrequency $frequency,
        int $interval,
        ?array $days
    ): bool {
        $diffInDays = $date->diffInDays($eventDate);

        switch ($frequency) {
            case EventFrequency::Never:
                return $diffInDays == 0;
            case EventFrequency::Daily:
                return $diffInDays % $interval == 0;
            case EventFrequency::Weekly:
                $diffInWeeks = $date
                    ->copy()
                    ->startOfWeek()
                    ->diffInWeeks($date->copy()->startOfWeek());
                return $diffInWeeks % $interval == 0 &&
                    in_array($date->dayOfWeekIso, $days);
            case EventFrequency::Monthly:
                return $eventDate->day == $date->day;
            case EventFrequency::Yearly:
                return $eventDate->day == $date->day &&
                    $eventDate->month == $date->month;
            default:
                return false;
        }
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
