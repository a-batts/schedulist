<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;

class ClassCreate extends Component
{
    /**
     * The new class
     *
     * @var Classes
     */
    public Classes $class;

    /**
     * Valid color options for the class
     *
     * @var array
     */
    private array $colorOptions = [
        'pink',
        'orange',
        'lemon',
        'mint',
        'blue',
        'teal',
        'purple',
        'lav',
        'beige',
    ];

    public array $errorMessages = [];

    /**
     * Validation rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'class.name' => 'required',
            'class.teacher' => 'required',
            'class.teacher_email' => 'nullable',
            'class.video_link' => 'nullable|url',
            'class.location' => 'nullable',
            'class.color' => 'required',
        ];
    }

    /**
     * Mount the component
     *
     * @return void
     */
    public function mount(): void
    {
        $this->class = new Classes(['color' => 'pink']);
    }

    /**
     * Create a new class
     *
     * @return void
     */
    public function create(): void
    {
        $this->validate();

        $class = $this->class;

        if (!isset($class->teacher_email) || $class->teacher_email == '') {
            $class->teacher_email = null;
        }
        if (!isset($class->location) || $class->location == '') {
            $class->location = null;
        }
        if ($class->video_link == '') {
            $class->video_link = null;
        }

        $newClass = Auth::user()
            ->classes()
            ->save($class);

        $this->emit('refreshClasses');
        $this->dispatchBrowserEvent('close-add-diag');
        $this->emit('toastMessage', 'Class successfully saved');
        $this->emit('updateClassData', $class->id);

        $this->class = new Classes(['color' => 'pink']);
    }

    /**
     * Set the color of the class
     *
     * @param string $color
     * @return void
     */
    public function setColor(string $color): void
    {
        $this->class->color = $color;
    }

    /**
     * Validate updated properties
     *
     * @param string $propertyName
     * @return void
     */
    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Render the component
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        $this->errorMessages = $this->getErrorBag()->toArray();

        return view('livewire.dashboard.class-create')->with(
            'colorOptions',
            $this->colorOptions
        );
    }
}
