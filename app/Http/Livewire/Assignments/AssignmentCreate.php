<?php

namespace App\Http\Livewire\Assignments;

use App\Models\Classes;
use App\Models\Assignment;

use Carbon\Carbon;
use Carbon\Exceptions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Str;

use Livewire\Component;

class AssignmentCreate extends Component
{
    public $assignment;

    public array $classes = [['id' => -1, 'name' => 'No Class']];

    public array $errorMessages = [];

    protected $listeners = ['setTime', 'setDate'];

    protected $messages = [
        'url' => 'Make sure the link is a valid URL',
    ];

    protected $rules = [
        'assignment.assignment_name' => 'required',
        'assignment.classid' => 'nullable',
        'assignment.due' => 'required',
        'assignment.assignment_link' => 'url|nullable',
        'assignment.description' => 'required',
        'assignment.status' => 'required',
        'assignment.userid' => 'required',
    ];

    /**
     * Mount component
     * @return void
     */
    public function mount(){
      $this->assignment = new Assignment;
      $this->assignment->status = 'inc';
      $this->assignment->due = Carbon::now()->setTime('23', '59', '59')->toString();
      $this->assignment->userid = Auth::User()->id;

      $classes = Classes::where('userid', Auth::User()->id)->get();
      foreach($classes as $class){
        array_push($this->classes, ['id' => $class->id, 'name' => $class->name]);
      }
    }

    public function create(){
      $this->validate();
      $assignment = $this->assignment;

      if ($assignment->classid == -1)
        $assignment->classid = null;

      $assignment->due = Carbon::parse($assignment->due);
      $assignment->url_string = Str::random(16);
      $assignment->assignment_name = Crypt::encryptString($assignment->assignment_name);
      $assignment->description = Crypt::encryptString($assignment->description);
      if (! preg_match('.*[a-zA-Z].*', $assignment_link))
        $assignment->link = null;
      if ($assignment->assignment_link != null)
        $assignment->assignment_link = Crypt::encryptString($assignment->assignment_link);

      $assignment->save();

      $this->resetAssignment();
      $this->emit('refreshAssignments');
      $this->dispatchBrowserEvent('close-dialog');
      $this->emit('toastMessage', 'Assignment was successfully created');
    }

    public function resetAssignment(){
      $this->assignment = new Assignment;
      $this->assignment->status = 'inc';
      $this->assignment->due = Carbon::now()->setTime('23', '59', '59')->toString();
      $this->assignment->userid = Auth::User()->id;
    }

    public function setClass($val){
      if (Classes::where('id', $val)->where('userid', Auth::User()->id)->exists() || $val == -1)
        $this->assignment->classid = $val;
    }

    public function setDate($val){
      $date = explode('-', $val);
      try { $this->assignment->due = Carbon::parse($this->assignment->due)->setDate($date[0], $date[1], $date[2])->toString(); }
      catch(Exceptions\InvalidFormatException $e){
        $this->addError('assignment.due', 'Invalid date inputted');
      }
    }

    public function setTime($val){
      $time = explode(':', $val);
      try { $this->assignment->due = Carbon::parse($this->assignment->due)->setTime($time[0], $time[1])->toString(); }
      catch(Exceptions\InvalidFormatException $e){
        $this->addError('assignment.due', 'Invalid time inputted');
      }
    }

    /**
     * Validate updated properties
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    public function render(){
      $this->errorMessages = $this->getErrorBag()->toArray();

      return view('livewire.assignments.assignment-create');
    }
}
