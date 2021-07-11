<?php

namespace App\Http\Livewire\Assignments;

use App\Classes\LinkPreview;

use App\Models\Assignment;
use App\Models\Classes;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Livewire\Component;

class AssignmentEdit extends Component
{
    public Assignment $assignment;

    public $classPeriod;
    public $title;
    public $time;
    public $date;
    public $link = "";

    public $classes;
    public $originalClass;

    public $errorMessages = [];

    protected $preview;

    protected $rules = [
        'title' => 'required',
        'assignment.description' => 'required',
        'link' => 'nullable|url',
    ];

    protected $listeners = ['refreshEditModal' => '$refresh', 'setTime', 'setDate'];

    /**
     * Mount component
     * @return void
     */
    public function mount(){
      $this->originalClass = Classes::where('id', $this->assignment->classid)->first();
      $this->classes = Classes::where('userid', Auth::user()->id)->orderBy('period', 'asc')->whereNotIn('id', [$this->assignment->classid])->get();
      if(isset($this->assignment->assignment_link))
        $this->link = Crypt::decryptString($this->assignment->assignment_link);
      $this->title = Crypt::decryptString($this->assignment->assignment_name);
      $this->assignment->description = Crypt::decryptString($this->assignment->description);

      $this->classPeriod = $this->assignment->classid;
      $this->time = Carbon::parse($this->assignment->due)->format('G:i');
      $this->date = Carbon::parse($this->assignment->due)->format('Y-m-d');

      $this->preview = LinkPreview::create($this->link);

      if(($this->assignment->link_description == null) || ($this->assignment->link_image == null))
        $this->preview = $this->preview->withoutExisting();
      else
        $this->preview = $this->preview->withExisting($this->assignment->link_image, $this->assignment->link_description);
    }

    /**
     * Validates updated properties
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function setTime($value){
      $this->time = $value;
    }

    public function setDate($value){
      $this->date = $value;
    }

    /**
     * Save updated assignment
     * @return void
     */
     public function save(){
       $validatedData = $this->validate();
       $assignment = $this->assignment;
       if($this->link == null){
         $assignment->assignment_link = null;
         $assignment->link_image = null;
         $assignment->link_description = null;
       }
       else{
         $this->preview = LinkPreview::create($this->link)->updatePreview($this->link);
         $assignment->assignment_link = Crypt::encryptString($this->link);
         $assignment->link_image = $this->preview->getPreview();
         $assignment->link_description = $this->preview->getText();
       }

       $assignment->assignment_name = Crypt::encryptString($this->title);
       $assignment->description = Crypt::encryptString($assignment->description);
       $assignment->classid = $this->classPeriod;
       $assignment->due = new Carbon($this->date.' '.$this->time);

       $assignment->save();
       $assignment->description = Crypt::decryptString($assignment->description);
       $this->emit('refreshAssignmentPage');
       $this->dispatchBrowserEvent('hide-edit-menu');
       $this->emit('toastMessage', 'Changes successfully saved');
     }

    /**
     * Delete assignment
     * @return void
     */
    public function delete(){
       $this->assignment->delete();
       $this->emit('navigate', '/assignments');
       $this->emit('toastMessage', 'Assignment was deleted');
    }

    /**
     * Enable or disable notifications
     * @return void
     */
    public function toggleNotification(){
        $assignment = $this->assignment;
        $assignment->description = Crypt::encryptString($assignment->description);
        if ($assignment->notifications_disabled == null)
          $assignment->notifications_disabled = 'yes';
        else
          $assignment->notifications_disabled = null;
        $assignment->save();
    }

    public function render(){
        $this->errorMessages = $this->getErrorBag()->toArray();
        if(! $this->errorBag->has('link'))
          $this->preview = LinkPreview::create($this->link)->updatePreview($this->link);
        else
          $this->preview = LinkPreview::create($this->link)->withError();

        $this->emit('setTime', $this->time);
        $this->emit('setDate', $this->date);
        if ($this->title == null)
          $this->dispatchBrowserEvent('cleared-field');
        return view('livewire.assignments.assignment-edit')->with('preview', $this->preview);
    }
}
