<?php

namespace App\Http\Livewire\Schedule;

use App\Models\Event;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class AgendaColorPicker extends Component
{
    protected $listeners = ['updateEventColor'];

    private $validColors = ['blue', 'lav', 'lemon', 'mint', 'orange', 'pink', 'purple', 'teal', 'beige'];

    public function updateEventColor($data){
      $event = Event::find($data['id']);
      if ($event->user_id == Auth::User()->id){
        if (in_array($data['color'], $this->validColors)){
          $event->color = $data['color'];
          $event->save();
        }
      }
    }

    public function render(){
        return view('livewire.schedule.agenda-color-picker');
    }
}
