<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AssignmentReminder extends Model
{
    use HasFactory;

    protected $appends = ['hours_before'];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function getHoursBeforeAttribute()
    {
        return floor(
            Carbon::parse($this->assignment->due)->diffInHours(
                Carbon::parse($this->reminder_time)
            )
        );
    }
}
