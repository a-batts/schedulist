<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTime extends Model
{
    use HasFactory;

    protected $appends = ['day', 'start', 'end'];

    protected $fillable = [
        'schedule_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    private $daysOfWeek = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
    ];

    public function getDayAttribute(): string
    {
        return $this->daysOfWeek[$this->day_of_week];
    }

    public function getStartAttribute(): string
    {
        return $this->formatTime($this->start_time);
    }

    public function getEndAttribute(): string
    {
        return $this->formatTime($this->end_time);
    }

    private function formatTime(string $time): string
    {
        $splitTime = explode(':', $time);
        return Carbon::now()
            ->setHours($splitTime[0])
            ->setMinutes($splitTime[1])
            ->format('g:i A');
    }
}
