<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassSchedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $appends = ['start', 'end', 'human_start', 'human_end'];

    protected $casts = [
        'name' => 'encrypted',
    ];

    protected static function booted(): void
    {
        static::deleting(function (ClassSchedule $schedule) {
            $schedule->times()->delete();
            foreach (
                Classes::where('schedule_id', $schedule->id)->get()
                as $class
            ) {
                $class->schedule_id = null;
                $class->save();
            }
        });
    }

    protected function start(): Attribute
    {
        return new Attribute(
            get: fn() => Carbon::parse($this->start_date)->format('n/j/Y')
        );
    }

    protected function end(): Attribute
    {
        return new Attribute(
            get: fn() => Carbon::parse($this->end_date)->format('n/j/Y')
        );
    }

    protected function humanStart(): Attribute
    {
        return new Attribute(
            get: fn() => Carbon::parse($this->start_date)->format('F jS, Y')
        );
    }

    protected function humanEnd(): Attribute
    {
        return new Attribute(
            get: fn() => Carbon::parse($this->end_date)->format('F jS, Y')
        );
    }

    public function times(): HasMany
    {
        return $this->hasMany(ClassTime::class, 'schedule_id');
    }
}
