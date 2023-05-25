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

    public string $sessionSent = 'verification_code_sent';

    public string $submit = 'verification_code_send';

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

        VerificationCode::send($this->email);

        session()->flash(
            $this->sessionSent,
            __('Enviamos um código de verificação para o seu e-mail.')
        );
    }
}
