<?php

namespace App\Enums;

enum GradeLevel: int
{
    case ElementarySchool = 1;
    case MiddleSchool = 2;
    case HighSchool = 3;
    case College = 4;
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
