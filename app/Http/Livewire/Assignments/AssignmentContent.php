<?php

namespace App\Http\Livewire\Assignments;

use App\Classes\LinkPreview;

use App\Models\Classes;
use App\Models\Assignment;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Livewire\Component;

class AssignmentContent extends Component
{
    public Assignment $assignment;

    public $assignmentString;

    public $classColor;

    protected $preview;

    protected $listeners = ['refreshAssignmentPage' => '$refresh'];

    public function mount(){
      $this->assignment = Assignment::where('url_string', $this->assignmentString)->first();
      if ($this->assignment->classid != null){
        $class = Classes::where('id', $this->assignment->classid)->first();
        if ($class != null)
          $this->classColor = strtolower($class->color);
      }
    }

    public function updateStatus(){
      $assignment = $this->assignment;
      if ($assignment->userid == Auth::User()->id){
        if ($assignment->status == 'inc')
          $assignment->status = 'done';
        else
          $assignment->status = 'inc';
        $assignment->save();
        $this->assignment = $assignment;
        $this->emit('toastMessage', 'Marked assignment as '.($assignment->status == 'done' ? 'done': 'incomplete'));
      }
    }

    public function render(){
      if ($this->assignment->assignment_link != null)
        $link = Crypt::decryptString($this->assignment->assignment_link);
      else
        $link = "";

      $this->preview = LinkPreview::create($link);
      if(($this->assignment->link_description == null) || ($this->assignment->link_image == null))
        $this->preview = $this->preview->withoutExisting();
      else
        $this->preview = $this->preview->withExisting($this->assignment->link_image, $this->assignment->link_description);

      return view('livewire.assignments.assignment-content')->with('preview', $this->preview);
    }
}
