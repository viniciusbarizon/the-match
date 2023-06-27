<?php

namespace App\Http\Livewire\JobSeeker\Create\Code;

use App\Http\Requests\JobSeeker\Code\SendRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Send extends Component
{
    protected $listeners = ['emailVerified' => 'disable'];

    public bool $disabled;

    public ?string $email;

    public function mount(): void
    {
        $this->setDisabled();
        $this->setEmail();
    }

    private function setDisabled(): void
    {
        $this->disabled = session()->has('is_email_verified');
    }

    private function setEmail(): void
    {
        $this->email = old('email', session('email'));
    }

    public function render(): View
    {
        return view('livewire.job-seeker.create.code.send');
    }

    protected function rules(): array
    {
        return (new SendRequest)->rules();
    }

    public function send(): void
    {
        $this->validate();

        $this->sendEmail();

        $this->setSessionEmail();

        $this->emit('emailSent', $this->email);

        $this->flashAlert();
    }

    private function flashAlert(): void
    {
        session()->flash('alert_message', 'Enviamos um código de verificação para o seu e-mail.');
    }

    private function sendEmail(): void
    {
        VerificationCode::send($this->email);
    }

    private function setSessionEmail(): void
    {
        session()->put('email', $this->email);
    }

    public function disable(): void
    {
        $this->disabled = true;
    }
}
