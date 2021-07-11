<?php

namespace App\Http\Livewire\Profile\Themes;

use Livewire\Component;

class ChangeThemes extends Component
{
    protected $listeners = ['refreshThemePage' => '$refresh'];

    /**
     * Load in the new selected theme
     * @param  string $theme
     * @return void
     */
    public function switchThemes($theme){
        $this->theme = $theme;
        $this->emit('refreshThemePage');
        $this->emit('themeSwitch', $theme);
    }

    public function render(){
        return view('livewire.profile.themes.change-themes');
    }
}
