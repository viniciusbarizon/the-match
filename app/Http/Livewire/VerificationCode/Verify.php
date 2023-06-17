<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\JobSeeker\VerificationCode\VerifyRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Verify extends Component
{
    public ?string $email = null;

    public ?string $code;

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
        if (session()->has('email_verified')) {
            $this->flashAlert(
                message: 'O e-mail já está verificado.',
                type: 'info'
            );

            return;
        }

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

        $this->setSessionEmailVerified();

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
        $this->code = '******';
        session()->put('email_verified', $this->email);
    }

    private function flashAlert(string $message, string $type): void
    {
        session()->flash('alert_message', $message);
        session()->flash('alert_type', $type);
    }
}
