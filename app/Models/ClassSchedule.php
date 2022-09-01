<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model {
    use HasFactory;

    protected $table = 'schedules';

    public function times() {
        return $this->hasMany(ClassTime::class, 'schedule_id');
    }
}
