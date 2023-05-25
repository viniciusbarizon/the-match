<?php

namespace App\Http\Livewire\VerificationCode;

use Livewire\Component;

class Verify extends Component
{
    public string $verificationCode;

    public string $verificationCodeName = 'verification_code';

    public string $submitName = 'verification_code_verify';

    public function render()
    {
        return view('livewire.verification-code.verify');
    }
}
