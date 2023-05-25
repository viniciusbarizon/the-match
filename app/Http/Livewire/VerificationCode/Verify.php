<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\VerificationCode\VerifyRequest;
use Illuminate\View\View;
use Livewire\Component;

class Verify extends Component
{
    public string $input = 'verification_code';

    public string $sessionVerified = 'verification_code_verified';

    public string $submit = 'verification_code_verify';

    public string $verificationCode;

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

        VerificationCode::verify($this->$verificationCode, $email);

        session()->flash(
            $this->sessionVerified,
            __('O código foi verificado!')
        );
    }
}
