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
     * @var array<Event>
     */
    public array $events = [];

    private const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    public function __construct(Carbon $date, array $queriedData)
    {
        $splits = 100;
        $this->date = $date->startOfDay();

        // Merge all the possible events into a single array
        $items = array_merge(
            $this->getAssignments(
                $queriedData['assignments'],
                $queriedData['classes']
            ),
            $this->getClasses($queriedData['schedule']),
            $this->getOtherEvents($queriedData['events'])
        );

        // Sort the events by start time
        usort($items, function ($a, $b) {
            return $a->top <=> $b->top;
        });

        // Sort events into columns for proper display on the front end
        $columns = [];
        foreach ($items as $index => $item) {
            $isInserted = false;
            for ($i = 0; $i < count($columns); $i++) {
                if (
                    $item->top > $columns[$i][count($columns[$i]) - 1]->bottom
                ) {
                    $columns[$i][] = $item;

                    // If there isn't an item next to the current item,
                    // make it span the remaining columns
                    // This fixes the current issue with empty columns next to
                    // items that could easily fill them all
                    if (
                        (count($items) > $index + 1 &&
                            $items[$index + 1]->top > $item->bottom) ||
                        $index + 1 == count($items)
                    ) {
                        $item->fullWidth = true;
                    }

                    // The item has been inserted so we break the loop
                    $isInserted = true;
                    break;
                }
            }
            // If the item could not be inserted into an existing column, add it to a new one
            if (!$isInserted) {
                $columns[] = [$item];
            }
        }

        // Determine the width of each column
        if (count($columns) > 0) {
            $splits = floor(100 / count($columns));
        }

        // Get the proper position for each item and add it to an array
        foreach ($columns as $index => $column) {
            foreach ($column as $item) {
                $item->left = $splits * $index;
                $item->width = $item->fullWidth ? 100 - $item->left : $splits;
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

            // Create an event for any assignments due on the requested date
            if ($this->date->toDateString() == $date->toDateString()) {
                $event = new Event(
                    date: $this->date,
                    id: $item->id,
                    type: 'assignment',
                    name: $item->name,
                    color: 'green',
                    start: $date,
                    link: route('assignmentPage') . '/' . $item->url_string,
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
     * @param ClassScheduleHelper $scheduleHelper
     * @return array<Event>
     */
    private function getClasses(ClassScheduleHelper $scheduleHelper): array
    {
        $events = [];

        // Get the classes that occur on the requested date
        $data = $scheduleHelper->getDayClasses($this->date);

        // Create an event for each class
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
            // If the event does not occur on this date at all skip to the next item
            if (
                $this->date < $item->date ||
                ($item->end_date != null && $this->date > $item->end_date)
            ) {
                continue;
            }

            // Keep track of all the events that occur on the provided date
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

                // Get the proper frequency description depending on how often the event happens
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
     * @param Carbon $eventDate
     * @param EventFrequency $frequency
     * @param integer $interval
     * @param array|null $days
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

        // Determine if the event occurs on the provided date based on its frequency
        switch ($frequency) {
            case EventFrequency::Never:
                return $diffInDays == 0;
            case EventFrequency::Daily:
                return $diffInDays % $interval == 0;
            case EventFrequency::Weekly:
                $diffInWeeks = $date
                    ->copy()
                    ->startOfWeek()
                    ->diffInWeeks($eventDate->copy()->startOfWeek());
                return $diffInWeeks % $interval == 0 &&
                    in_array($date->dayOfWeekIso, $days);
            case EventFrequency::Monthly:
                return $eventDate->day == $date->day;
            case EventFrequency::Yearly:
                return $eventDate->day == $date->day &&
                    $eventDate->month == $date->month;
        }
        return false;
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
