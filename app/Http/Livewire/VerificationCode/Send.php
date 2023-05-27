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

    public string $session_email_has_been_sent = 'verification_code_email_has_been_sent';

    private string $message;

    public function render(): View
    {
        return view('livewire.verification-code.send');
    }

    protected function rules(): array
    {
        return (new SendRequest)->rules();
    }

    public function send(): void
    {
        $this->validate();

        $this->sendEmail();

        $this->emit('emailSent', $this->email);

        $this->setMessage();
        $this->flashMessage();
    }

    private function sendEmail(): void
    {
        VerificationCode::send($this->email);
    }

    private function setMessage(): void
    {
        $this->message = 'Enviamos um código de verificação para o seu e-mail.';
    }

    private function flashMessage(): void
    {
        session()->flash($this->session_email_has_been_sent, true);
    }
}
