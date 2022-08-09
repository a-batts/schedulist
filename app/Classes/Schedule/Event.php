<?php

namespace App\Classes\Schedule;

use Carbon\Carbon;

class Event {

    private Carbon $date;
    public int $id;

    public string $type;

    public string $name;

    public ?string $link;

    public string $color;

    private Carbon $start;

    private ?Carbon $end;

    public int $top;

    public int $bottom;

    public int $left;

    public int $height;

    public array $data = [];

    public function __construct(
        Carbon $date,
        int $id,
        string $type,
        string $name,
        ?string $link,
        string $color,
        Carbon $start,
        ?Carbon $end,
        int $top,
        int $bottom,
        ?array $data = null,
        ?int $left = 0,
        ?int $height = 1
    ) {
        $this->date = $date;
        $this->id = $id;
        $this->type = strtolower($type);
        $this->name = $name;
        $this->link = $link;
        $this->color = $color;
        $this->start = $start;
        $this->end = $end;
        $this->top = $top;
        $this->bottom = $bottom;
        $this->data = $data;
        $this->left = $left;
        $this->height = $height;
    }

    /**
     * Return the event's date
     *
     * @return Carbon event date
     */
    public function getDate(): Carbon {
        return $this->date;
    }

    /**
     * Get the array representation of the event's data
     *
     * @return array data
     */
    public function toArray(): array {
        return array_merge(
            get_object_vars($this),
            [
                'startString' => $this->getStartString(),
                'endString' => $this->getEndString(),
                'timeString' => $this->getTimeString(),
            ]
        );
    }

    /**
     * Get the string representation of the event start
     *
     * @return string
     */
    public function getStartString(): string {
        if ($this->type == 'assignment')
            return 'Due at ' . $this->start->format('g:i A');
        return $this->start->format('g:i A');
    }

    /**
     * Get the string representation of the event end
     *
     * @return string|null
     */
    public function getEndString(): ?string {
        return isset($this->end) ? $this->end->format('g:i A') : null;
    }

    /**
     * Get the string representation of the event span
     *
     * @return string
     */
    public function getTimeString(): string {
        if ($this->type == 'assignment')
            return 'Due ' . $this->start->format('g:i A');
        return $this->start->format('g:i') . ' - ' . $this->end->format('g:i A');
    }
}
