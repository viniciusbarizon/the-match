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

    public ?string $email;

    public string $input = 'email';

    public ?string $readonly;

    public function mount(): void
    {
        $this->setEmail();
        $this->setReadOnly();
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

        $this->alert_message = __('Enviamos um código de verificação para o seu e-mail.');
        $this->alert_type = 'success';
        $this->flashAlert();
    }

    private function setEmail(): void
    {
        $this->email = session('email_verified', old('email'));
    }

    private function setReadOnly(): void
    {
        if (session()->missing('email_verified')) {
            return;
        }

        $this->readonly = "readonly=readonly";
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
