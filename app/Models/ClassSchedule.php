<?php

namespace App\Models;

use Carbon\Carbon;
use Crypt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model {
    use HasFactory;

    protected $table = 'schedules';

    protected $appends = [
        'start', 'end', 'human_start', 'human_end'
    ];

    protected $casts = [
        'name' => 'encrypted',
    ];


    public function times() {
        return $this->hasMany(ClassTime::class, 'schedule_id');
    }

    public function getStartAttribute() {
        return Carbon::parse($this->start_date)->format('n/j/Y');
    }

    public function getEndAttribute() {
        return Carbon::parse($this->end_date)->format('n/j/Y');
    }

    public function getHumanStartAttribute() {
        return Carbon::parse($this->start_date)->format('F jS, Y');
    }

    public function getHumanEndAttribute() {
        return Carbon::parse($this->end_date)->format('F jS, Y');
    }
}
