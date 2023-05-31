<?php

namespace App\Http\Livewire\JobSeeker\CreateOrEdit;

use Livewire\Component;

class Url extends Component
{
    public string $inputName = 'name';

    public function render()
    {
        return view('livewire.job-seeker.create-or-edit.url');
    }
}
