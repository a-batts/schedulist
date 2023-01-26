<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentReminder extends Model
{
    use HasFactory;

    protected $appends = ['hours_before'];

    protected $fillable = ['reminder_time'];

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    protected function hoursBefore(): Attribute
    {
        return new Attribute(
            get: fn() => floor(
                Carbon::parse($this->assignment->due)->diffInHours(
                    Carbon::parse($this->reminder_time)
                )
            )
        );
    }
}
