<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\JobSeeker\VerificationCode\SendRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Send extends Component
{
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
            session()->flash('info', true);
            return;
        }

        $this->sendEmail();

        $this->emit('emailSent', $this->email);

        session()->flash('success', true);
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

    private function flashMessage(string $type, string $message): void
    {
        session()->flash('success', true);
    }
}
