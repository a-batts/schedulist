<?php

namespace App\Filament\Resources\ClassTimesResource\Pages;

use App\Filament\Resources\ClassTimesResource;
use Filament\Resources\Pages\ListRecords;

class ListClassTimes extends ListRecords
{
    public static $resource = ClassTimesResource::class;
    public static $title = 'Manage Class Times';
}
