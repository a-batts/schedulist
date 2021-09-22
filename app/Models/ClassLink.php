<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassLink extends Model
{
    use HasFactory;
    
    protected $table = 'class_links';

    protected $guarded = ['id', 'class_id'];

}
