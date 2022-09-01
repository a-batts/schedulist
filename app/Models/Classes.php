<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Classes extends Model {
  use HasFactory;

  protected $table = 'classes';

  protected $guarded = ['id', 'userid'];

  public function getTeacherNameAttribute() {
    return isset($this->teacher) ? Crypt::decryptString($this->teacher) : '';
  }

  public function getLocationAttribute() {
    return isset($this->class_location) ? Crypt::decryptString($this->class_location) : '';
  }

  public function links() {
    return $this->hasMany(ClassLink::class, 'class_id');
  }
}
