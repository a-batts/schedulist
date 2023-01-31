<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ClassLinkCreate extends Component
{
    /**
     * Add a link to a class
     *
     * @param integer $classID
     * @param string $name
     * @param string $url
     * @return boolean|int
     */
    public function addLink(
        int $classId,
        ?string $name,
        ?string $url
    ): bool|array {
        Validator::make(
            ['name' => $name, 'url' => $url],
            [
                'name' => 'required|min:3',
                'url' => 'required|url',
            ],
            ['url.url' => 'Please provide a valid url.']
        )->validate();

        try {
            $class = Auth::user()
                ->classes()
                ->findOrFail($classId);
            $newLink = $class->links()->create([
                'name' => $name,
                'link' => $url,
            ]);
            return ['id' => $newLink->id];
        } catch (ModelNotFoundException) {
        }
        return false;
    }

    public function render()
    {
        return view('livewire.dashboard.class-link-create');
    }
}
