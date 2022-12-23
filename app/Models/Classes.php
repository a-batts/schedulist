<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

  public function assignments() {
    return $this->hasMany(Assignment::class, 'class_id');
  }

  public function links() {
    return $this->hasMany(ClassLink::class, 'class_id');
  }

  public function times() {
    return $this->hasMany(ClassTime::class, 'class_id');
  }
}
