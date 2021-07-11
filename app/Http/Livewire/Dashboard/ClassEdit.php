<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Classes;

use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

use Livewire\Component;

class ClassEdit extends Component
{
    /**
     * Array of class periods that the user has not filled
     * @var array
     */
    public array $hasclass =  [];

    /**
     * Array of arrays of all the user's class data
     * @var array
     */
    public array $classData = [];

    /**
     * Holds the inital class period
     * @var int
     */
    public $initPeriod;

    public bool $toggleControl = false;

    protected $listeners = ['resetEditValidation', 'updateClassData'];

    /**
     * Validation rules
     * @return array
     */
    function rules() {
      return [
          'editclass.period' => 'required|digits_between:1,8',
          'editclass.name' => 'required|string|max:255',
          'editclass.teacher' => 'required|string|max:255',
          'editclass.teacher_email' => 'nullable|email|max:255',
          'editclass.class_link' => 'required|url',
          'editclass.color' => 'required',
          'editclass.g_classroom' => 'nullable|regex:/classroom\.google\.com\/c\//',
          'editclass.blackboard' => 'nullable|regex:/blackboard\.com\//',
          'editclass.textbook' => 'nullable|url',
          'editclass.ap_classroom' => 'nullable|regex:/apclassroom\.collegeboard\.org\//',
          'editclass.linkone' => 'nullable|string|url',
          'editclass.linkone_name' => 'nullable|string|max:50',
          'editclass.linktwo' => 'nullable|string|url',
          'editclass.linktwo_name' => 'nullable|string|max:50',
          'editclass.linkthree' => 'nullable|string|url',
          'editclass.linkthree_name' => 'nullable|string|max:50'

      ];
    }

    protected $messages = [
        'editclass.period.required' => 'The class period is required',
        'editclass.period.digits_between' => 'That\'s not a valid class period',
        'editclass.name.required' => 'A name for the class is required',
        'editclass.teacher.required' => 'The class teacher is required',
        'editclass.teacher_email.email' => 'Double check that the teacher email is valid',
        'editclass.class_link.required' => 'A class link is required',
        'editclass.class_link.url' => 'The class link is not a valid URL',
        'editclass.color.required' => 'A color for this class is required',
        'editclass.g_classroom.regex' => 'Double check the Google Classroom link',
        'editclass.blackboard.regex' => 'Double check the Blackboard link',
        'editclass.ap_classroom.regex' => 'Double check the AP Classroom link',
        'editclass.linkone.url' => 'Double check that link one is a valid URL',
        'editclass.linktwo.url' => 'Double check that link two is a valid URL',
        'editclass.linkthree.url' => 'Double check that link three is a valid URL'
    ];

    /**
     * Class data array
     * @var array
     */
    public $editclass = [
      'period' => null,
      'color' => null,
      'teacher_email' => null,
      'g_classroom' => null,
      'blackboard' => null,
      'textbook' => null,
      'ap_classroom' => null,
      'linkone' => null,
      'linktwo' => null,
      'linkthree' => null,
      'linkone_name' => null,
      'linktwo_name' => null,
      'linkthree_name' => null
    ];

    /**
     * Mount component
     * @return void
     */
    public function mount() {
      for ($i=1; $i <= 10; $i++) {
        $class = Classes::where('userid', Auth::user()->id)->where('period', $i)->first();
        if($class != null)
          $this->classData[$i] = $this->decryptClassData($i, $class);
      }
    }

    public function decryptClassData($period, $class){
      $dataArray = $class->withoutRelations()->toArray();

      foreach ($dataArray as $key => $value) {
        try {
          $dataArray[$key] = Crypt::decryptString($value);
        } catch (DecryptException $e) {
            //
        }
      }
      return $dataArray;
    }

    /**
     * Update classData array with newly added class
     * @param  int $newPeriod
     * @return void
     */
    public function updateClassData($newPeriod){
      $class = Classes::where('userid', Auth::user()->id)->where('period', $newPeriod)->first();
      $this->classData[$newPeriod] = $this->decryptClassData($newPeriod, $class);
    }

    /**
     * Validate updated properties
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName) {
        $this->validateOnly($propertyName);
    }

    /**
     * Set edit class value and decrypt values
     */
    public function resetEditValidation(){
      $this->resetValidation();
    }

    /**
     * Set period from select component
     * @param int $period
     */
    public function setPeriod(int $period){
      $this->editclass['period'] = $period;
    }

    /**
     * Set color from select component
     * @param string $color
     */
    public function setColor(string $color){
      $this->editclass['color'] = $color;
    }

    /**
     * Saves the updated class
     * @return void
     */
    public function save(){
      $this->validate();
      $class = Classes::where('userid', Auth::user()->id)->where('period', $this->initPeriod)->first();

      $editclass = $this->editclass;
      $class->period = $editclass['period'];
      $class->name = $editclass['name'];
      $class->teacher = Crypt::encryptString($editclass['teacher']);
      if (isset($editclass['teacher_email']))
        $class->teacher_email = Crypt::encryptString($editclass['teacher_email']);
      $class->class_link = Crypt::encryptString($editclass['class_link']);
      $class->color = $editclass['color'];
      if (isset($editclass['g_classroom']))
        $class->g_classroom = Crypt::encryptString($editclass['g_classroom']);
      if (isset($editclass['blackboard']))
        $class->blackboard = Crypt::encryptString($editclass['blackboard']);
      if (isset($editclass['textbook']))
        $class->textbook = Crypt::encryptString($editclass['textbook']);
      if (isset($editclass['ap_classroom']))
        $class->ap_classroom = Crypt::encryptString($editclass['ap_classroom']);
      if (isset($editclass['linkone']))
        $class->linkone = Crypt::encryptString($editclass['linkone']);
      $class->linkone_name = $editclass['linkone_name'];
      if (isset($editclass['linktwo']))
        $class->linktwo = Crypt::encryptString($editclass['linktwo']);
      $class->linktwo_name = $editclass['linktwo_name'];
      if (isset($editclass['linkthree']))
        $class->linkthree = Crypt::encryptString($editclass['linkthree']);
      $class->linkthree_name = $editclass['linkthree_name'];

      $class->save();

      $this->updateClassData($editclass['period']);
      $this->updateClassData($editclass['period']);

      $this->reset('editclass');
      $this->dispatchBrowserEvent('close-edit-modal');
      $this->toggleControl = false;
      $this->emit('refreshClassCards');
      $this->emit('undofix');
      $this->emit('toastMessage', 'Class successfully updated');
      $this->initPeriod = null;
      $this->grabPeriodsArray();

    }

    /**
     * Grab array of classes
     * @return void
     */
    public function grabPeriodsArray(){
      $this->hasclass = [];
      for ($i = 1; $i <= 10; $i++){
        if ($i == $this->initPeriod || ! Classes::where('userid', Auth::user()->id)->where('period', $i)->exists())
          array_push($this->hasclass, $i);
      }
    }

    public function render(){
        $this->grabPeriodsArray();
        return view('livewire.dashboard.class-edit');
    }
}
