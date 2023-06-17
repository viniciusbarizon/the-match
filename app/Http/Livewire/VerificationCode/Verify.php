<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\JobSeeker\VerificationCode\VerifyRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Verify extends Component
{
    public ?string $code;

    public bool $disabled;

    public ?string $email = null;

    protected $listeners = ['emailSent' => 'setEmail'];

    public function mount(): void
    {
        $this->setCode();
        $this->setDisabled();
    }

    private function setCode(): void
    {
        $this->code = old('code', null);
    }

    private function setDisabled(): void
    {
        $this->disabled = session()->has('email_verified');
    }

    public function render(): View
    {
        return view('livewire.verification-code.verify');
    }

    protected function rules(): array
    {
        return (new VerifyRequest)->rules();
    }

    public function verify(): void
    {
        if (is_null($this->email)) {
            $this->flashAlert(
                message: 'Preencha o seu email e clique em enviar código antes da verificação.',
                type: 'info'
            );

            return;
        }

        $this->validate();

        if ($this->verifyCode() === false) {
            $this->flashAlert(
                message: 'Código inválido, por favor tente novamente.',
                type: 'danger'
            );

            return;
        }

        $this->code = null;
        $this->disabled = true;

        $this->setSessionEmailVerified();
        $this->emit('emailVerified');

        $this->flashAlert(
            message: 'O Código foi verificado com sucesso!',
            type: 'success'
        );
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    private function verifyCode(): bool
    {
        return VerificationCode::verify($this->code, $this->email);
    }

    private function setSessionEmailVerified(): void
    {
        session()->put('email_verified', $this->email);
    }

    private function flashAlert(string $message, string $type): void
    {
        session()->flash('alert_message', $message);
        session()->flash('alert_type', $type);
    }
}
