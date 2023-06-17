<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\JobSeeker\VerificationCode\SendRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Send extends Component
{
    public bool $disabled;

    public ?string $email;

    public function mount(): void
    {
        $this->setDisabled();
        $this->setEmail();
    }

    private function setDisabled(): void
    {
        $this->disabled = session()->has('email_verified');
    }

    private function setEmail(): void
    {
        $this->email = session('email_verified', old('email'));
    }

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
        if (session()->has('email_verified')) {
            $this->flashAlert(
                message: __('O e-mail :email já está verificado.', ['email' => session('email_verified'),]),
                type: 'info'
            );

            return;
        }

        $this->validate();

        $this->sendEmail();

        $this->emit('emailSent', $this->email);

        $this->flashAlert(
            message: __('Enviamos um código de verificação para o seu e-mail.'),
            type: 'success'
        );
    }

    private function flashAlert(string $message, string $type): void
    {
        session()->flash('alert_message', $message);
        session()->flash('alert_type', $type);
    }

    private function sendEmail(): void
    {
        VerificationCode::send($this->email);
    }
}
