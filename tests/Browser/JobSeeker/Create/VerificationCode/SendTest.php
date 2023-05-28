<?php

namespace Tests\Browser\JobSeeker\Create\VerificationCode;

use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SendTest extends DuskTestCase
{
    const EMAIL = '@email';

    const SEND_VERIFICATION_CODE = '@send_code';

    public function testSendCode(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(__('Email'))
                ->assertVisible(self::EMAIL)
                ->assertAttribute(self::EMAIL, 'autocomplete', 'email')
                ->assertAttribute(self::EMAIL, 'name', 'email')
                ->assertAttribute(self::EMAIL, 'required', true)
                ->assertAttribute(self::EMAIL, 'type', 'email')
                ->assertAttribute(self::EMAIL, 'wire:model.defer', 'email')
                ->assertVisible(self::SEND_VERIFICATION_CODE)
                ->assertAttribute(self::SEND_VERIFICATION_CODE, 'type', 'button')
                ->assertSeeIn(self::SEND_VERIFICATION_CODE, __('Enviar código de verificação'))
                ->click(self::SEND_VERIFICATION_CODE)
                ->waitForText(__('O campo e-mail é obrigatório.'), 1)
                ->type('email', Str::random(25))
                ->click(self::SEND_VERIFICATION_CODE)
                ->waitForText(__('O campo e-mail não contém um endereço de email válido.'), 1)
                ->type('email', 'viniciusbarizon@gmail.com')
                ->click(self::SEND_VERIFICATION_CODE)
                ->waitForText(__('Enviamos um código de verificação para o seu e-mail.'), 1);
        });
    }
}
