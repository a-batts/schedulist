<?php

namespace App\Models;

use App\Models\Classes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assignment extends Model {
  use HasFactory;

  protected $table = 'assignments';

  protected $guarded = ['id', 'user_id', 'class_id'];

  protected $casts = [
    'name' => 'encrypted',
    'description' => 'encrypted',
    'link' => 'encrypted',
  ];

  protected $appends = [
    'human_due', 'is_late', 'due_in_next_month'
  ];

  protected static function booted(): void {

    static::deleting(function (Assignment $assignment) {
      $assignment->notes()->delete();
      $assignment->reminders()->delete();
    });
  }

  protected function className(): Attribute {
    return new Attribute(
      get: function () {
        if ($this->class_id == null)
          return 'No Class';

        return $this->class != null ? $this->class->name : 'Deleted Class';
      },
    );
  }

  protected function humanDue(): Attribute {
    return new Attribute(
      get: fn () => Carbon::parse($this->due)->format('M j, g:i A'),
    );
  }

  protected function dueDate(): Attribute {
    return new Attribute(
      get: fn () => Carbon::parse($this->due)->format('M j, Y'),
    );
  }

  protected function dueDateW(): Attribute {
    return new Attribute(
      get: fn () => Carbon::parse($this->due)->format('D'),
    );
  }

  protected function dueTime(): Attribute {
    return new Attribute(
      get: fn () => Carbon::parse($this->due)->format('g:i A'),
    );
  }

  protected function createdDate(): Attribute {
    return new Attribute(
      get: fn () => Carbon::parse($this->created_at)->format('M j, Y'),
    );
  }

  protected function editedDate(): Attribute {
    return new Attribute(
      get: fn () => $this->created_at != $this->updated_at ? Carbon::parse($this->updated_at)->format('M j') : null,
    );
  }

  protected function isLate(): Attribute {
    return new Attribute(
      get: fn () => Carbon::parse($this->due) < Carbon::now(),
    );
  }

  protected function dueInNextMonth(): Attribute {
    return new Attribute(
      get: fn () => Carbon::parse($this->due)->setTime(0, 0) < Carbon::now()->addDays(30)->setTime(0, 1),
    );
  }

  public function class(): BelongsTo {
    return $this->belongsTo(Classes::class, 'class_id');
  }

  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

  public function notes(): HasMany {
    return $this->hasMany(AssignmentNote::class);
  }

  public function reminders(): HasMany {
    return $this->hasMany(AssignmentReminder::class);
  }
}
