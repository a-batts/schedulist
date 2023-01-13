<?php

namespace App\Enums;

enum EventCategory: int
{
    case ClubMeeting = 1;
    case Exam = 2;
    case Game = 3;
    case Meeting = 4;
    case Quiz = 5;
    case Practice = 6;
    case WorkShift = 7;
    case Other = 0;

    /**
     * Return the formatted name (converts PascalCase to Sentence Case)
     *
     * @return string
     */
    public function formattedName(): string
    {
        return implode(' ', preg_split('/(?=[A-Z])/', $this->name));
    }
}
