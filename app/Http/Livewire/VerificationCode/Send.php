<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\VerificationCode\SendRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Send extends Component
{
    public string $email;

    public string $emailName = 'email';

    public string $submitName = 'verification_code_send';

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
            'verification-code-send-message',
            __('Enviamos um código de verificação para o seu e-mail.')
        );
    }
}
