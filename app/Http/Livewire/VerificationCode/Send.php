<?php

namespace App\Http\Livewire\VerificationCode;

use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Send extends Component
{
    public string $email;

    public function render(): View
    {
        return view('livewire.verification-code.send');
    }

    public function submit()
    {
        VerificationCode::send($this->email);
    }
}
