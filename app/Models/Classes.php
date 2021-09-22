<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $guarded = ['id', 'userid'];

    public function links(){
      return $this->hasMany(ClassLink::class, 'class_id');
    }
}
