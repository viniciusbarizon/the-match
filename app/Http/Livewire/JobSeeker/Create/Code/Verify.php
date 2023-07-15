<?php

namespace App\Http\Livewire\JobSeeker\Create\Code;

use App\Http\Requests\JobSeeker\Code\VerifyRequest;
use Illuminate\View\View;
use Livewire\Component;
use NextApps\VerificationCode\Models\VerificationCode as VerificationCodeModel;
use NextApps\VerificationCode\VerificationCode;

class Verify extends Component
{
    public ?string $code;

    public bool $disabled;

    public ?string $email = null;

    protected $listeners = ['emailSent' => 'enable'];

    public function mount(): void
    {
        $this->setDisabled();
    }

    private function setDisabled(): void
    {
        $this->disabled = session('is_email_verified', $this->wasEmailSent());
    }

    private function wasEmailSent(): bool
    {
        if (session()->missing('email')) {
            return true;
        }

        return VerificationCodeModel::where('verifiable', session('email'))
            ->where('expires_at', '>', now())
            ->doesntExist();
    }

    public function render(): View
    {
        return view('livewire.job-seeker.create.code.verify');
    }

    protected function rules(): array
    {
        return (new VerifyRequest)->rules();
    }

    public function verify(): void
    {
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

    public function enable(): void
    {
        $this->disabled = false;
    }

    private function verifyCode(): bool
    {
        if (session()->missing('email')) {
            return false;
        }

        return VerificationCode::verify($this->code, session('email'));
    }

    private function setSessionEmailVerified(): void
    {
        session()->put('is_email_verified', true);
    }

    private function flashAlert(string $message, string $type): void
    {
        session()->flash('alert_message', $message);
        session()->flash('alert_type', $type);
    }
}
