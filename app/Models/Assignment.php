<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use Carbon\Carbon;

class Assignment extends Model {
  use HasFactory;

  protected $table = 'assignments';

  protected $guarded = ['id', 'user_id', 'class_id'];

  protected $casts = [
    'name' => 'encrypted',
    'description' => 'encrypted',
  ];

  protected $appends = [
    'humanDue', 'isLate', 'dueInNextMonth'
  ];

  public function getClassNameAttribute(): string {
    if ($this->class_id == null)
      return 'No Class';

    $class = Classes::where('id', $this->class_id)->first();
    return $class != null ? $class->name : 'Deleted Class';
  }

  public function getHumanDueAttribute(): string {
    return Carbon::parse($this->due)->format('M j, g:i A');
  }

  public function getDueDateAttribute(): string {
    return Carbon::parse($this->due)->format('M j, Y');
  }

  public function getDueDateWAttribute(): string {
    return Carbon::parse($this->due)->format('D');
  }

  public function getDueTimeAttribute(): string {
    return Carbon::parse($this->due)->format('g:i A');
  }

  public function getCreatedDateAttribute(): string {
    return Carbon::parse($this->created_at)->format('M j, Y');
  }

  public function getEditedDateAttribute(): ?string {
    return $this->created_at != $this->updated_at ? Carbon::parse($this->updated_at)->format('M j') : null;
  }

  public function getIsLateAttribute(): bool {
    return Carbon::parse($this->due) < Carbon::now();
  }

  public function getDueInNextMonthAttribute(): bool {
    return Carbon::parse($this->due)->setTime(0, 0) < Carbon::now()->addDays(30)->setTime(0, 1);
  }

  public function reminders() {
    return $this->hasMany(AssignmentReminder::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function notes() {
    return $this->hasMany(AssignmentNote::class);
  }
}
