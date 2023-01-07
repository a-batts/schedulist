<?php

namespace App\Enums\Assignment;

enum AssignmentStatus: int
{
    case Incomplete = 0;
    case Completed = 1;

    /**
     * Return the opposite status
     *
     * @return AssignmentStatus
     */
    public function inverse(): AssignmentStatus
    {
        return $this->value == 0
            ? AssignmentStatus::Completed
            : AssignmentStatus::Incomplete;
    }
}
