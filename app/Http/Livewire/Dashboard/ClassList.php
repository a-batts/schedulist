<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Classes;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class ClassList extends Component {
  public $classes;

  protected $listeners = ['refreshClasses'];

  public function mount() {
    $this->refreshClasses();
  }

  public function refreshClasses() {
    $this->classes = Auth::User()->classes()->orderBy('name', 'asc')->with('links')->get();
  }

  public function render() {
    return view('livewire.dashboard.class-list');
  }
}
