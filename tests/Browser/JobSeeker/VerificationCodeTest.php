<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VerificationCodeTest extends DuskTestCase
{
    const EMAIL = '@email';

    const SEND_VERIFICATION_CODE = '@send_code';

    public function testVerificationCode(): void
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
                ->type('email', 'viniciusbarizon@gmail.com')
                ->click(self::SEND_VERIFICATION_CODE)
                ->waitForText(__('Enviamos um código de verificação para o seu e-mail.'), 1);
        });
    }
}
