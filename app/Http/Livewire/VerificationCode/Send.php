<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\SendVerificationCodeRequest;
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
        return (new SendVerificationCodeRequest)->rules();
    }

    public function submit()
    {
        $this->validate();

        VerificationCode::send($this->email);

        session()->flash('verification-code-send-message', 'Um código de verificação foi enviado para o seu e-mail.');
    }
}
