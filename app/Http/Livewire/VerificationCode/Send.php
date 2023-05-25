<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\VerificationCode\SendRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Send extends Component
{
    public string $email;

    public string $input = 'email';

    public string $sessionAlert = 'verification_code_send';

    public string $submit = 'verification_code_send';

    private string $message;

    public function render(): View
    {
        return view('livewire.verification-code.send');
    }

    protected function rules(): array
    {
        return (new SendRequest)->rules();
    }

    public function submit(): void
    {
        $this->validate();

        $this->send();

        $this->setSessionEmail();

        $this->message = 'Enviamos um código de verificação para o seu e-mail.';

        $this->flashMessage();
    }

    private function send(): void
    {
        VerificationCode::send($this->email);
    }

    private function setSessionEmail(): void
    {
        session('email', $this->email);
    }

    private function flashMessage(): void
    {
        session()->flash($this->sessionAlert, __($this->message));
    }
}
