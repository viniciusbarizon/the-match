<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\JobSeeker\VerificationCode\VerifyRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Verify extends Component
{
    public string $email;

    public string $input = 'verification_code';

    public int $max_length = 6;

    public string $session_successfully_verified = 'verification_code_successfully_verified';

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
        if ($this->isEmailAlreadyVerified()) {
            session()->flash('message', true);
            return;
        }

        $this->validate();

        $this->verifyCode();

        $this->setSessionEmailVerified();
        $this->flashSuccessfullyVerified();
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    private function verifyCode(): void
    {
        if (isset($this->email) === false) {
            $this->successfully_verified = false;

            return;
        }

        $this->successfully_verified = VerificationCode::verify(
            $this->verification_code,
            $this->email
        );
    }

    private function setSessionEmailVerified(): void
    {
        if ($this->successfully_verified === false) {
            return;
        }

        $this->verification_code = '******';
        session()->put('email_verified', $this->email);
    }

    private function flashSuccessfullyVerified(): void
    {
        session()->flash(
            $this->session_successfully_verified,
            $this->successfully_verified
        );
    }
}
