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

  public function getClassNameAttribute() {
    if ($this->class_id == null)
      return 'No Class';

    $class = Classes::where('id', $this->class_id)->first();
    if ($class != null)
      return $class->name;
    return 'Deleted Class';
  }

  public function getDueDateAttribute() {
    return Carbon::parse($this->due)->format('M j, Y');
  }

  public function getDueDateWAttribute() {
    return Carbon::parse($this->due)->format('D');
  }

  public function getDueTimeAttribute() {
    return Carbon::parse($this->due)->format('g:i A');
  }

  public function getCreatedDateAttribute() {
    return Carbon::parse($this->created_at)->format('M j, Y');
  }

  public function getEditedDateAttribute() {
    if ($this->created_at != $this->updated_at)
      return Carbon::parse($this->updated_at)->format('M j');
    return null;
  }

  public function getIsLateAttribute() {
    if (Carbon::parse($this->due) < Carbon::now())
      return true;
    return false;
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
