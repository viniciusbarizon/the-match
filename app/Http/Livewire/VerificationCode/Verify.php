<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\VerificationCode\VerifyRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Verify extends Component
{
    public string $duskButton = 'verification_code_verify';

    public string $input = 'verification_code';

    private bool $successfullyVerified;

    public string $sessionSuccessfullyVerified = 'verification_code_verified';

    public string $verificationCode;

    public function render(): View
    {
        return view('livewire.verification-code.verify');
    }

    protected function rules(): array
    {
        return (new VerifyRequest)->rules();
    }

    public function verify(): void
    {
        $this->validate();

        $this->verifyCode();

        $this->flashSuccessfullyVerified();
    }

    private function verifyCode(): void
    {
        $this->successfullyVerified = VerificationCode::verify(
            $this->$verificationCode,
            $email
        );
    }

    private function flashSuccessfullyVerified(): void
    {
        session()->flash(
            $this->sessionSuccessfullyVerified,
            $this->successfullyVerified
        );
    }
}
