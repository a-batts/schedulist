<?php

namespace App\Classes\Calendar;

use Carbon\Carbon;

/**
 * Individual agenda item
 */
class Event{

    public array $eventData = [];

    private Carbon $date;

    public function __construct(array $data, Carbon $date){
        $this->eventData = $data;
        $this->date = $date;
    }

    public function getDate(){
        return $this->date;
    }

    public function toArray(){
        return $this->eventData;
    }

}
