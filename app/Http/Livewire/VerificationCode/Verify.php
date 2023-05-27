<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\VerificationCode\VerifyRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Verify extends Component
{
    public string $dusk_button = 'verification_code_verify';

    public string $email;

    public string $input = 'verification_code';

    public string $session_successfully_verified = 'code_successfully_verified';

    private bool $successfully_verified;

    public string $verification_code;

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
        $this->successfully_verified = VerificationCode::verify(
            $this->verification_code,
            $this->email
        );
    }

    private function flashSuccessfullyVerified(): void
    {
        session()->flash(
            $this->session_successfully_verified,
            $this->successfully_verified
        );
    }
}
