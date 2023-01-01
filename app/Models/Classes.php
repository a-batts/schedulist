<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classes extends Model {
  use HasFactory;

  protected $table = 'classes';

  protected $guarded = ['id', 'user_id'];

  protected $casts = [
    'name' => 'encrypted',
    'teacher' => 'encrypted',
    'teacher_email' => 'encrypted',
    'video_link' => 'encrypted',
    'location' => 'encrypted'
  ];

  protected static function booted(): void {

    static::deleting(function (Classes $class) {
      $class->links()->delete();
      $class->times()->delete();
    });
  }

  public function assignments(): HasMany {
    return $this->hasMany(Assignment::class, 'class_id')->orderBy('due');
  }

  public function links(): HasMany {
    return $this->hasMany(ClassLink::class, 'class_id');
  }

  public function times(): HasMany {
    return $this->hasMany(ClassTime::class, 'class_id');
  }

  public function schedule(): BelongsTo {
    return $this->belongsTo(ClassSchedule::class, 'schedule_id');
  }
}
