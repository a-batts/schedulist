<?php

namespace App\Classes\Schedule;

use Carbon\Carbon;

class Event
{
    public int $left;

    public function __construct(
        public Carbon $date,
        public int $id,
        public string $type,
        public string $name,
        public string $color,
        public Carbon $start,
        public int $top,
        public int $bottom,
        public ?string $link = null,
        public ?Carbon $end = null,
        public ?array $data = []
    ) {
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
     * Get the array representation of the event's data
     *
     * @return array data
     */
    public function toArray(): array
    {
        return array_merge(get_object_vars($this), [
            'startString' => $this->getStartString(),
            'endString' => $this->getEndString(),
            'timeString' => $this->getTimeString(),
        ]);
    }

    /**
     * Get the string representation of the event start
     *
     * @return string
     */
    public function getStartString(): string
    {
        if ($this->type == 'assignment') {
            return 'Due at ' . $this->start->format('g:i A');
        }
        return $this->start->format('g:i A');
    }

    /**
     * Get the string representation of the event end
     *
     * @return string|null
     */
    public function getEndString(): ?string
    {
        return isset($this->end) ? $this->end->format('g:i A') : null;
    }

    /**
     * Get the string representation of the event span
     *
     * @return string
     */
    public function getTimeString(): string
    {
        if ($this->type == 'assignment') {
            return 'Due ' . $this->start->format('g:i A');
        }
        return $this->start->format('g:i') .
            ' - ' .
            $this->end->format('g:i A');
    }
}
