<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class DeleteClass extends Component
{
    public $deleteperiod;
    protected $listeners = ['selectedPeriod'];

    /**
     * Select the period of class to be deleted
     * @param  int $select
     * @return void
     */
    public function selectedPeriod($select){
      $this->deleteperiod = $select;
    }

    /**
     * Delete selected class and refresh Livewire
     * @return void
     */
    public function deleteClass(){
      $classid = Classes::where('userid', Auth::user()->id)->where('period', $this->deleteperiod)->first();
      DB::table('assignments')->where('userid', Auth::user()->id)->where('classid', $classid->id)->delete();
      DB::table('classes')->where('userid', Auth::user()->id)->where('period', $this->deleteperiod)->delete();
      $this->emit('refreshClasses');
    }

    public function render(){
        return view('livewire.dashboard.delete-class');
    }
}
