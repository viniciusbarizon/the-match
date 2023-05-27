<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\VerificationCode\VerifyRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Verify extends Component
{
    public string $duskButton = 'verification_code_verify';

    public string $email;

    public string $input = 'verification_code';

    private bool $successfullyVerified;

    public string $sessionSuccessfullyVerified = 'code_successfully_verified';

    public string $verificationCode;

    public function render(): View
    {
        return view('livewire.verification-code.verify');
    }

    protected $listeners = ['emailSent' => 'setEmail'];

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

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    private function verifyCode(): void
    {
        $this->successfullyVerified = VerificationCode::verify(
            $this->verificationCode,
            $this->email
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
