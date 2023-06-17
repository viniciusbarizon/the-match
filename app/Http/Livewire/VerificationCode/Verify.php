<?php

namespace App\Http\Livewire\VerificationCode;

use App\Http\Requests\JobSeeker\VerificationCode\VerifyRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\VerificationCode;

class Verify extends Component
{
    private string $alertMessage;

    private string $alertType;

    public ?string $email = null;

    private bool $isCodeValid;

    public string $verificationCode;

    public function render(): View
    {
        return view('livewire.verification-code.verify');
    }

    protected $listeners = ['emailSent' => 'setEmail'];

    protected function rules(): array
    {
        return (new VerifyRequest)->rules();
    }

    public function verify(): void
    {
        if (session()->has('email_verified')) {
            $this->setAlert(message: 'O e-mail já está verificado.', type: 'info');
            $this->flashAlert();

            return;
        }

        if (is_null($this->email)) {
            $this->setAlert(message: 'Preencha o seu email e clique em enviar código antes da verificação.', type: 'info');
            $this->flashAlert();

            return;
        }

        $this->validate();

        if ($this->verifyCode() === false) {
            $this->setAlert(message: 'Código inválido, por favor tente novamente.', type: 'danger');
            $this->flashAlert();

            return;
        }

        $this->setSessionEmailVerified();

        $this->setAlert(message: 'O Código foi verificado com sucesso!', type: 'success');
        $this->flashAlert();
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    private function setAlert(string $message, string $type): void
    {
        $this->alertMessage = $message;
        $this->alertType = $type;
    }

    private function verifyCode(): bool
    {
        return VerificationCode::verify($this->verificationCode, $this->email);
    }

    private function setSessionEmailVerified(): void
    {
        $this->verificationCode = '******';
        session()->put('email_verified', $this->email);
    }

    private function flashAlert(): void
    {
        session()->flash('alert_message', $this->alertMessage);
        session()->flash('alert_type', $this->alertType);
    }
}
