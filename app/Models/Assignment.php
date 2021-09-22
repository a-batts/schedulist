<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;
use Carbon\Carbon;

class Assignment extends Model
{
    use HasFactory;

    protected $table = 'assignments';

    protected $guarded = ['id', 'userid', 'classid'];

    public function getClassNameAttribute($value){
      if ($this->classid)
        return 'No Class';

      $class = Classes::where('id', $this->classid)->first();
      if ($class != null)
        return 'Deleted Class';
      return null;
    }

    public function getDueDateAttribute($value){
      return Carbon::parse($this->due)->format('M j');
    }

    public function getDueDateWAttribute($value){
      return Carbon::parse($this->due)->format('D');
    }

    public function getDueTimeAttribute($value){
      return Carbon::parse($this->due)->format('g:i A');
    }

    public function getIsDueTodayAttribute($value){
      if(Carbon::now()->toDateString() == Carbon::parse($this->due)->toDateString()){
        return true;
      }
      return false;
    }

    public function getIsLateAttribute($value){
      if(Carbon::now()->toDateString() > Carbon::parse($this->due)->toDateString()){
        return true;
      }
      return false;
    }

    public function getCreatedDateAttribute($value){
      return Carbon::parse($this->created_at)->format('M j');
    }

    public function getEditedDateAttribute($value){
      if ($this->created_at != $this->updated_at)
        return Carbon::parse($this->updated_at)->format('M j');
      return null;
    }
}
