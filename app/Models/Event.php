<?php

namespace App\Models;

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

    protected $table = 'events';

    protected $guarded = ['date'];

    protected $casts = [
        'name' => 'encrypted',
    ];

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
}
