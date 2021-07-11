<?php

namespace App\Http\Livewire\Assignments;

use App\Models\Classes;
use App\Models\Assignment;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;

use Livewire\Component;

class AssignmentCreate extends Component
{
    public $assignmentModal = false;
    public $usersClasses;

    public $name;
    public $classId;
    public $date;
    public $time;
    public $link;
    public $description;

    protected $listeners = ['updateTime', 'updateDate'];

    protected $rules = [
        'name' => 'required',
        'classId' => 'required',
        'date' => 'required',
        'time' => 'required',
        'description' => 'required'
    ];

    /**
     * Mount component
     * @return void
     */
    public function mount(){
      $this->usersClasses = Classes::where('userid', Auth::user()->id)->orderBy('period', 'asc')->get();
      $this->time = "23:59";
      $this->date = Carbon::now()->addDay()->toDateString();
    }

    /**
     * Update time from Vue
     * @param string $value
     * @return void
     */
    public function updateTime($value){
      $this->time = $value;
    }

    /**
     * Update date from Vue
     * @param  string $value
     * @return void
     */
    public function updateDate($value){
      $this->date = $value;
    }

    public function setClass($value){
      $classId = Classes::where('userid', Auth::user()->id)->where('period', $value)->first();
      $this->classId = $classId->id;
    }

    public function save(){
      $this->validate();

      $assignment = new Assignment;
      $assignment->assignment_name = Crypt::encryptString($this->name);
      $assignment->userid = Auth::User()->id;
      $assignment->classid = $this->classId;
      $assignment->due = new Carbon($this->date.' '.$this->time);
      $assignment->description = Crypt::encryptString($this->description);
      if ($this->link != null)
        $assignment->assignment_link = Crypt::encryptString($this->link);
      $assignment->status = 'inc';
      $assignment->url_string = Str::random(16);
      $assignment->save();

      $this->emit('refreshAssignments');
      $this->dispatchBrowserEvent('close-assignment-modal');
      $this->emit('toastMessage', 'Assignment was successfully added');
    }

    public function render(){
        return view('livewire.assignments.assignment-create');
    }
}
