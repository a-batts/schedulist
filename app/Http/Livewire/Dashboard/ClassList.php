<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Collection;

use Livewire\Component;

class ClassList extends Component {
  /**
   * Collection of the user's classes
   *
   * @var Collection
   */
  public Collection $classes;

  protected array $listeners = ['refreshClasses'];

  /**
   * Mount the component
   *
   * @return void
   */
  public function mount(): void {
    $this->refreshClasses();
  }

  /**
   * Refresh the user's classes
   *
   * @return void
   */
  public function refreshClasses(): void {
    $this->classes = Auth::User()->classes()->orderBy('name', 'asc')->with('links')->get();
  }

  /**
   * Render the component
   *
   * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
   */
  public function render() {
    return view('livewire.dashboard.class-list');
  }
}
