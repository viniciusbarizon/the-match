<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\VerificationCode\VerifyRequest;
use Illuminate\View\View;
use Livewire\Component;

class Verify extends Component
{
    public string $verificationCode;

    public string $verificationCodeName = 'verification_code';

    public string $sessionName = 'verification-code-verify-message';

    public string $submitName = 'verification_code_verify';

    public function render(): View
    {
        return view('livewire.verification-code.verify');
    }

    protected function rules(): array
    {
        return (new VerifyRequest)->rules();
    }

    public function submit(): void
    {
        $this->validate();
    }
}
