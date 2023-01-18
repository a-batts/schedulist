<?php

namespace App\Enums;

enum EventFrequency: int
{
    case Never = 0;
    case Daily = 1;
    case Weekly = 2;
    case Monthly = 3;
    case Yearly = 4;

    /**
     * Return the unit string
     *
     * @return string
     */
    public function getUnit(): string
    {
        return match ($this) {
            $this::Never => '',
            $this::Daily => 'day',
            $this::Weekly => 'week',
            $this::Monthly => 'month',
            $this::Yearly => 'year',
        };
    }
}
