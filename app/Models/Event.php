<?php

namespace App\Models;

use App\Enums\EventCategory;
use App\Enums\EventFrequency;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    use HasFactory;

    const VALID_COLORS = [
        'blue',
        'lav',
        'lemon',
        'mint',
        'orange',
        'pink',
        'purple',
        'teal',
        'beige',
    ];

    protected $appends = ['formatted_date', 'formatted_time'];

    protected $casts = [
        'name' => 'encrypted',
        'location' => 'encrypted',
        'category' => EventCategory::class,
        'frequency' => EventFrequency::class,
        'days' => 'array',
        'date' => 'date',
        'end_date' => 'date',
    ];

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'frequency',
        'interval',
    ];

    protected $table = 'events';

    protected static function booted(): void
    {
        static::deleting(function (Event $event) {
            $event->sharings()->delete();
        });
    }

    protected function formattedDate(): Attribute
    {
        return new Attribute(
            get: fn() => Carbon::parse($this->date)->format('D, F jS, Y')
        );
    }

    protected function formattedTime(): Attribute
    {
        return new Attribute(
            get: fn() => Carbon::parse($this->start_time)->format('g:i A') .
                ' - ' .
                Carbon::parse($this->end_time)->format('g:i A')
        );
    }

    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'owner');
    }

    public function sharedWith(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->wherePivot(
            'user_id',
            '!=',
            Auth::id()
        );
    }

    public function sharings(): HasMany
    {
        return $this->hasMany(EventUser::class);
    }

    /**
     * Return whether or not a user owns this event
     *
     * @param User $user
     * @return boolean
     */
    public function isOwner(User $user): bool
    {
        return $user->id == $this->owner;
    }
}
