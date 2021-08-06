<?php

namespace App\Http\Livewire\Assignments;

use App\Models\Classes;
use App\Models\Assignment;

use Carbon\Carbon;

use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Livewire\Component;

class AssignmentList extends Component
{
    public $assignments;

    public $class;

    public $classes = [];

    public $due = 'Incomplete';

    public $filters = 'Incomplete,Completed';

    protected $listeners = ['refreshAssignments'];

    public function mount(){
      $classes = Classes::where('userid', Auth::User()->id)->get();
      foreach($classes as $class){
        array_push($this->classes, ['id' => $class->id, 'name' => $class->name]);
      }
      if ($this->class != -1)
        $this->class = Classes::where('id', (int) $this->class)->where('userid', Auth::User()->id)->first()->id;

      $this->assignments = $this->getAssignments();
    }

    public function getAssignments(){
      $assignments = Assignment::where('userid', Auth::User()->id)->orderBy('due', 'asc')->get()->toArray();
      foreach($assignments as $key => $value){
        $assignments[$key]['assignment_name'] = Crypt::decryptString($value['assignment_name']);
        $due = Carbon::parse($value['due']);
        $assignments[$key]['due_time'] = $due->format('g:i A');
        $assignments[$key]['due_date'] = $due->format('M j');
        $assignments[$key]['description'] = Crypt::decryptString($value['description']);
        if ($value['classid'] != null){
          $k = array_search($value['classid'], array_column($this->classes, 'id'));
          if ($k == false)
            $assignments[$key]['class_name'] = 'Deleted Class';
          else
            $assignments[$key]['class_name'] = $this->classes[$k]['name'];
        }
        else
          $assignments[$key]['class_name'] = 'No Class';

        try{
          $assignments[$key]['assignment_link'] = Crypt::decryptString($value['assignment_link']);

        }
        catch(DecryptException $e){

        }
      }
      return $assignments;
    }

    public function refreshAssignments(){
      $this->assignments = $this->getAssignments();
      $this->dispatchBrowserEvent('update-assignments');
    }

    public function updateStatus($id){
      $assignment = Assignment::findOrFail($id);
      if ($assignment->userid == Auth::User()->id){
        if ($assignment->status == 'inc')
          $assignment->status = 'done';
        else
          $assignment->status = 'inc';
        $assignment->save();
        $this->refreshAssignments();
        $this->emit('toastMessage', 'Marked assignment as '.($assignment->status == 'done' ? 'done': 'incomplete'));
      }
    }

    public function render(){
        return view('livewire.assignments.assignment-list');
    }
}
