<?php

namespace App\Http\Livewire\Assignments;

use App\Models\Classes;
use App\Models\Assignment;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Assignments extends Component
{

    public $period;
    public $due;
    public $classes;

    protected $listeners = ['refreshAssignments' => '$refresh'];
    /**
     * Get assignments for today
     * @return \App\Models\Assignment
     */
    public function getTodayAssignments(){
      $day = Carbon::now()->format('d');
      if ($this->period != null){
        $class = Classes::where(['userid' => Auth::user()->id, 'period' => $this->period])->first();
        return Assignment::where(['userid' => Auth::user()->id, 'classid' => $class->id, 'status' => 'inc'])->whereDate('due', Carbon::now()->toDateString())->whereTime('due', '>', Carbon::now()->toTimeString())->orderBy('due', 'asc')->get();
      }
      else
        return Assignment::where(['userid' => Auth::user()->id, 'status' => 'inc'])->whereDate('due', Carbon::now()->toDateString())->whereTime('due', '>', Carbon::now()->toTimeString())->orderBy('due', 'asc')->get();
    }

    /**
     * Get assignments for next week
     * @return \App\Models\Assignment
     */
    public function getWeekAssignments(){
      $tomorrow = Carbon::now()->addDay()->toDateString();
      $nextWeek = Carbon::now()->addWeek()->toDateString();
      if ($this->period != null){
        $class = Classes::where(['userid' => Auth::user()->id, 'period' => $this->period])->first();
        return Assignment::where(['userid' => Auth::user()->id, 'classid' => $class->id, 'status' => 'inc'])->whereDate('due', '>=', $tomorrow)->whereDate('due', '<', $nextWeek)->orderBy('due', 'asc')->get();
      }
      else
        return Assignment::where(['userid' => Auth::user()->id, 'status' => 'inc'])->whereDate('due', '>=', $tomorrow)->whereDate('due', '<', $nextWeek)->orderBy('due', 'asc')->get();
    }

    /**
     * Get assignments for rest of time
     * @return \App\Models\Assignment
     */
    public function getRemainingAssingments(){
      $nextWeek = Carbon::now()->addWeek()->toDateString();
      if ($this->period != null){
        $assignment = Classes::where(['userid' => Auth::user()->id, 'period' => $this->period])->first();
        return Assignment::where(['userid' => Auth::user()->id, 'classid' => $assignment->id, 'status' => 'inc'])->whereDate('due', '>=', $nextWeek)->orderBy('due', 'asc')->get();
      }
      else{
        return Assignment::where(['userid' => Auth::user()->id, 'status' => 'inc'])->whereDate('due', '>=', $nextWeek)->orderBy('due', 'asc')->get();
      }
    }

    /**
     * Get all assignments (for categories that aren't incomplete)
     * @return \App\Models\Assignment
     */
    public function getAllAssignments(){
      if ($this->due != 'late')
        if ($this->period != null){
          $assignment = Classes::where(['userid' => Auth::user()->id, 'period' => $this->period])->first();
          return Assignment::where(['userid' => Auth::user()->id, 'classid' => $assignment->id, 'status' => $this->due])->orderBy('due', 'desc')->get();
        }
        else{
          return Assignment::where(['userid' => Auth::user()->id, 'status' => $this->due])->orderBy('due', 'desc')->get();
        }
      else{
        if ($this->period != null){
          $assignment = Classes::where(['userid' => Auth::user()->id, 'period' => $this->period])->first();
          return Assignment::where(['userid' => Auth::user()->id, 'classid' => $assignment->id, 'status' => 'inc'])->where('due', '<=', Carbon::now())->orderBy('due', 'asc')->get();
        }
        else{
          return Assignment::where(['userid' => Auth::user()->id, 'status' => 'inc'])->where('due', '<=', Carbon::now())->orderBy('due', 'asc')->get();
        }
      }
    }

    /**
     * Get string of period and class name
     * @return string
     */
    public function getClassString(): string{
      $classObj = Classes::where(['userid' => Auth::user()->id, 'period' => $this->period])->first();
      return ($classObj->period.': '.$classObj->name);
    }

    /**
     * Change period of assignments being displayed
     * @param  int $new
     * @return void
     */
    public function swapPeriod($new){
      $this->emit('startloading', 1);
      if ($this->due == null){
        if ($new != null){
          $this->period = $new;
          $this->emit('updateurl', $new, null);
        }
        else{
          $this->period = null;
          $this->emit('updateurl', 0, null);
        }
      }
      else{
        if ($new != null){
          $this->period = $new;
          $this->emit('updateurl', $new.'/'.$this->due, null);
        }
        else{;
          $this->period = null;
          $this->emit('updateurl', 'x/'.$this->due, null);

        }
      }
      $this->emit('refreshAssignments');
      $this->emit('stoploading');
    }

    /**
     * Change due status of assignments being displayed
     * @param  int $new
     * @return void
     */
    public function swapDue($new){
      $this->emit('startloading', 1);
      if ($this->period == null){
        if ($new != null){
          $this->due = $new;
          $this->emit('updateurl', 'x/'.$this->due, null);
        }
        else{
          $this->due = null;
          $this->emit('updateurl', 0, null);
        }
      }
      else{
        if ($new != null){
          $this->due = $new;
          $this->emit('updateurl', $this->period.'/'.$this->due, null);
        }
        else{
          $this->due = null;
          $this->emit('updateurl', $this->period, null);
        }
      }
      $this->emit('stoploading', 1);
      $this->emit('refreshAssignments');
    }

    /**
     * Mark assignemnt as complete
     * @param  int $assignment_id
     * @return void
     */
    public function markDone($assignment_id){
      $assignment = Assignment::where('id', $assignment_id)->first();
      $assignment->status = 'done';
      $assignment->save();
    }

    public function render(){
      $this->classes = Classes::where('userid', Auth::user()->id)->orderBy('period', 'asc')->get();
      if ($this->due == null)
        return view('livewire.assignments.assignments')->with(['todayassignments'=> $this->getTodayAssignments(), 'weekassignments' => $this->getWeekAssignments(), 'remainingassignments' => $this->getRemainingAssingments()]);
      else
        return view('livewire.assignments.assignments')->with('assignments', $this->getAllAssignments());
    }
}
