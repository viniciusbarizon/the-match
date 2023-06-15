<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\JobSeeker\VerificationCode\SendRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Send extends Component
{
    private string $alert_message;

    private string $alert_type;

    public string $email;

    public string $input = 'email';

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

        if ($this->isEmailAlreadyVerified()) {
            $this->alert_message = 'Este e-mail já está verificado.';
            $this->alert_type = 'info';
            $this->flashAlert();
            return;
        }

        $this->sendEmail();

        $this->emit('emailSent', $this->email);

        $this->alert_message = 'Enviamos um código de verificação para o seu e-mail.';
        $this->alert_type = 'success';
        $this->flashAlert();
    }

    public function mount(): void
    {
        if (old('email')) {
            $this->email = old('email');
        }
    }

    private function isEmailAlreadyVerified(): bool
    {
        return session('email_verified') == $this->email;
    }

    private function sendEmail(): void
    {
        VerificationCode::send($this->email);
    }

    private function flashAlert(): void
    {
        session()->flash('alert_message', $this->alert_message);
        session()->flash('alert_type', $this->alert_type);
    }
}
