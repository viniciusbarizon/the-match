<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\SendVerificationCodeRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Send extends Component
{
    public string $email;

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
    }
}
