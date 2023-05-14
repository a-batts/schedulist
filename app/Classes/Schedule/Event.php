<?php

namespace App\Classes\Schedule;

use Carbon\Carbon;
use Carbon\CarbonInterval;

class Event
{
    public int $left;

    public int $top;

    public int $bottom;

    public int $width;

    public bool $fullWidth = false;

    public function __construct(
        public Carbon $date,
        public int $id,
        public string $type,
        public string $name,
        public string $color,
        public Carbon $start,
        public ?string $link = null,
        public ?Carbon $end = null,
        public ?array $data = []
    ) {
        if ($this->end != null) {
            $this->top =
                CarbonInterval::minutes($this->start->format('i'))->hours(
                    $this->start->format('G')
                )->totalSeconds / Schedule::SCALE_FACTOR;

            $this->bottom =
                CarbonInterval::minutes($this->end->format('i'))->hours(
                    $this->end->format('G')
                )->totalSeconds / Schedule::SCALE_FACTOR;
        }
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

    /**
     * Set the top value
     *
     * @param integer $top
     * @return static
     */
    public function setTop(int $top): static
    {
        $this->top = $top;
        return $this;
    }

    /**
     * Set the bottom value
     *
     * @param integer $bottom
     * @return static
     */
    public function setBottom(int $bottom): static
    {
        $this->bottom = $bottom;
        return $this;
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
}
