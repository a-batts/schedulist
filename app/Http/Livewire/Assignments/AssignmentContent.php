<?php

namespace App\Http\Livewire\Assignments;

use App\Classes\LinkPreview;

use App\Models\Assignment;

use Illuminate\Support\Facades\Crypt;

use Livewire\Component;

class AssignmentContent extends Component
{
    public $assignment;
    public $assignment_string;
    protected $preview;

    protected $listeners = ['refreshAssignmentPage' => '$refresh'];

    public function mount(){
      $this->assignment = Assignment::where('url_string', $this->assignment_string)->first();
    }

    /**
     * Marks assignment as done
     * @param  int $assignment_id
     * @return void
     */
    public function markDone($assignment_id){
        $assignment = $this->assignment;
        $assignment->status = 'done';
        $assignment->save();
        $this->emit('toastMessage', 'Assignment marked as completed');
        $assignment = Assignment::where('id', $assignment_id)->first();
    }

    /**
     * Marks assignment as incomplete
     * @param  int $assignment_id
     * @return void
     */
    public function markIncomplete($assignment_id){
        $assignment = $this->assignment;
        $assignment->status = 'inc';
        $this->emit('refreshAssignmentPage');
        $assignment->save();
        $this->emit('toastMessage', 'Assignment marked as incomplete');
        $assignment = Assignment::where('id', $assignment_id)->first();
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
