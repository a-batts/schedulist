<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Classes;
use App\Models\ClassLink;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class ClassDelete extends Component {
  public function delete($id) {
    $class = Classes::find($id);
    if ($class != null && $class->userid == Auth::User()->id) {
      ClassLink::where('class_id', $class->id)->delete();
      $class->delete();
      $this->emit('toastMessage', 'Class successfully deleted');
      $this->emit('refreshClasses');
    } else
      $this->emit('toastMessage', 'Unable to delete class');
    $this->dispatchBrowserEvent('deletion-finished');
  }

  public function render() {
    return view('livewire.dashboard.class-delete');
  }
}
