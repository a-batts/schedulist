<?php

namespace App\Enums;

enum DataCategory: string
{
    case Assignment = 'assignments';
    case Classes = 'classes';
    case Event = 'events';
    case Schedule = 'schedules';
    case ProfileData = 'profile';
}
