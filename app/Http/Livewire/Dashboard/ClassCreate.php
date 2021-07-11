<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;


class ClassCreate extends Component
{

    protected $listeners = ['refreshClasses' => '$refresh', 'closeAddModal', 'closeMoreLinksAdd'];

    public $addClassModal = false;
    public $showingMoreLinks = false;
    public $newestClass;
    public $errorMessages = [];

    function rules() {
      return [
          'newclass.period' => 'required|digits_between:1,8',
          'newclass.name' => 'required|string|max:255',
          'newclass.teacher' => 'required|string|max:255',
          'newclass.teacher_email' => 'nullable|email|max:255',
          'newclass.class_link' => 'required|url',
          'newclass.color' => 'required',
          'newclass.g_classroom' => 'nullable|regex:/classroom\.google\.com\/c\//',
          'newclass.blackboard' => 'nullable|regex:/blackboard\.com\//',
          'newclass.textbook' => 'nullable|url',
          'newclass.ap_classroom' => 'nullable|regex:/apclassroom\.collegeboard\.org\//',
          'newclass.linkone' => 'nullable|string|url',
          'newclass.linkone_name' => 'nullable|string|max:50',
          'newclass.linktwo' => 'nullable|string|url',
          'newclass.linktwo_name' => 'nullable|string|max:50',
          'newclass.linkthree' => 'nullable|string|url',
          'newclass.linkthree_name' => 'nullable|string|max:50'

      ];
    }

    protected $messages = [
        'newclass.period.required' => 'The class period is required',
        'newclass.period.digits_between' => 'That\'s not a valid class period',
        'newclass.name.required' => 'A name for the class is required',
        'newclass.teacher.required' => 'The class teacher is required',
        'newclass.teacher_email.email' => 'Double check that the teacher email is valid',
        'newclass.class_link.required' => 'A class link is required',
        'newclass.class_link.url' => 'The class link is not a valid URL',
        'newclass.color.required' => 'A color for this class is required',
        'newclass.g_classroom.regex' => 'Double check the Google Classroom link',
        'newclass.blackboard.regex' => 'Double check the Blackboard link',
        'newclass.ap_classroom.regex' => 'Double check the AP Classroom link',
        'newclass.linkone.url' => 'Double check that link one is a valid URL',
        'newclass.linktwo.url' => 'Double check that link two is a valid URL',
        'newclass.linkthree.url' => 'Double check that link three is a valid URL'
    ];

    public $newclass = [
      'linkone_name' => null,
      'linktwo_name' => null,
      'linkthree_name' => null
    ];

    public $hasclass = [];

    /**
     * Validate updated properties
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    /**
     * Set period property from select component
     * @param int $period
     */
    public function setPeriod(int $period){
      $this->newclass['period'] = $period;
    }

    /**
     * Set color property from select component
     * @param string $color
     */
    public function setColor($color){
      $this->newclass['color'] = $color;
    }

    /**
     * Grab array of classes
     * @return void
     */
    public function grabPeriodsArray(){
      $this->reset('hasclass');
      for ($i = 1; $i <= 10; $i++){
        if (! Classes::where('userid', Auth::user()->id)->where('period', $i)->exists())
          array_push($this->hasclass, $i);
      }
    }

    /**
     * Reverse the creation of class
     * @return void
     */
    public function undo(){
      Classes::where('userid', Auth::user()->id)->where('period', $this->newestClass)->delete();
      $this->emit('getUserClasses');
    }

    /**
     * Save the new class and refresh class card component
     * @return void
     */
    public function save(){
      $this->validate();
      $newclass = $this->newclass;
      $class = new Classes;
      $class->userid = Auth::User()->id;
      $class->period = $newclass['period'];
      $class->name = $newclass['name'];
      $class->teacher = Crypt::encryptString($newclass['teacher']);
      if (isset($newclass['teacher_email']))
        $class->teacher_email = Crypt::encryptString($newclass['teacher_email']);
      $class->class_link = Crypt::encryptString($newclass['class_link']);
      $class->color = $newclass['color'];
      if (isset($editclass['g_classroom']))
        $class->g_classroom = Crypt::encryptString($newclass['g_classroom']);
      if (isset($editclass['blackboard']))
        $class->blackboard = Crypt::encryptString($newclass['blackboard']);
      if (isset($editclass['textbook']))
        $class->textbook = Crypt::encryptString($newclass['textbook']);
      if (isset($editclass['ap_classroom']))
        $class->ap_classroom = Crypt::encryptString($newclass['ap_classroom']);
      if (isset($newclass['linkone']))
        $class->linkone = Crypt::encryptString($newclass['linkone']);
      $class->linkone_name = $newclass['linkone_name'];
      if (isset($newclass['linktwo']))
        $class->linktwo = Crypt::encryptString($newclass['linktwo']);
      $class->linktwo_name = $newclass['linktwo_name'];
      if (isset($newclass['linkthree']))
        $class->linkthree = Crypt::encryptString($newclass['linkthree']);
      $class->linkthree_name = $newclass['linkthree_name'];

      $class->save();
      $this->newestClass = $newclass['period'];
      $this->reset('newclass');
      $this->addClassModal = false;
      $this->showingMoreLinks = false;
      $this->emit('refreshClassCards');
      $this->emit('refreshClasses');
      $this->emit('updateClassData', $newclass['period']);
      $this->grabPeriodsArray();
      $this->emit('undofix');
      $this->emit('toastMessage', 'Class successfully added');

    }

    public function render(){
        $this->errorMessages = $this->getErrorBag()->toArray();
        $this->grabPeriodsArray();
        return view('livewire.dashboard.class-create');
    }
}
