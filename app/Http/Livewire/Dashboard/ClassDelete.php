<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class ClassDelete extends Component {

  /**
   * Delete a class by id
   *
   * @param int $id
   * @return void
   */
  public function delete(int $id): void {
    $this->emit('deleteClass', $id);
  }

  /**
   * Render the component
   *
   * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
   */
  public function render() {
    return view('livewire.dashboard.class-delete');
  }
}
