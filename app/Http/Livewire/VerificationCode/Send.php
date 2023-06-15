<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\JobSeeker\VerificationCode\SendRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Send extends Component
{
    private string $alertMessage;

    private string $alertType;

    public readonly bool $disabled;

    public ?string $email;

    public string $input = 'email';

    public ?string $readonly;

    public function mount(): void
    {
        $this->setDisabled();
        $this->setEmail();
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
            $this->alert_message = __('O e-mail :email já está verificado.', ['email' => session('email_verified')]);
            $this->alert_type = 'info';
            $this->flashAlert();
            return;
        }

        $this->validate();

        $this->sendEmail();

        $this->emit('emailSent', $this->email);

        $this->alertMessage = __('Enviamos um código de verificação para o seu e-mail.');
        $this->alertType = 'success';
        $this->flashAlert();
    }

    private function setDisabled(): void
    {
        $this->disabled = session()->has('email_verified');
    }

    private function setEmail(): void
    {
        $this->email = session('email_verified', old('email'));
    }

    private function sendEmail(): void
    {
        VerificationCode::send($this->email);
    }

    private function flashAlert(): void
    {
        session()->flash('alert_message', $this->alertMessage);
        session()->flash('alert_type', $this->alertType);
    }
}
