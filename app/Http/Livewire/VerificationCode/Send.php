<?php

namespace App\Http\Livewire\VerificationCode;

use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Send extends Component
{
    public $email;

    public function render()
    {
        return view('livewire.verification-code.send');
    }

    public function submit()
    {
        VerificationCode::send($this->email);
    }
}
