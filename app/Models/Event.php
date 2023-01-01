<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model {
    use HasFactory;

    const VALID_COLORS =  ['blue', 'lav', 'lemon', 'mint', 'orange', 'pink', 'purple', 'teal', 'beige'];

    protected $table = 'events';

    protected $guarded = ['date'];

    protected $casts = [
        'name' => 'encrypted',
    ];

    protected static function booted(): void {

        static::deleting(function (Event $event) {
            $event->sharings()->delete();
        });
    }

    public function sharings(): HasMany {
        return $this->hasMany(EventUser::class);
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class);
    }
}
