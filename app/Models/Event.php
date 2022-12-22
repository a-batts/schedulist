<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    use HasFactory;

    protected $table = 'events';

    protected $guarded = ['date'];

    protected $casts = [
        'name' => 'encrypted',
    ];

    const VALID_COLORS =  ['blue', 'lav', 'lemon', 'mint', 'orange', 'pink', 'purple', 'teal', 'beige'];

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
