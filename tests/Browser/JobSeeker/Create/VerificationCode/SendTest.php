<?php

namespace Tests\Browser\JobSeeker\Create\VerificationCode;

use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SendTest extends DuskTestCase
{
    const DUSK_EMAIL = '@email';

    const EMAIL = 'email';

    const SEND_CODE = '@send_code';

    public function testSendCode(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(__('Email'))
                ->assertVisible(self::DUSK_EMAIL)
                ->assertAttribute(self::DUSK_EMAIL, 'autocomplete', self::EMAIL)
                ->assertAttribute(self::DUSK_EMAIL, 'name', self::EMAIL)
                ->assertAttribute(self::DUSK_EMAIL, 'required', true)
                ->assertAttribute(self::DUSK_EMAIL, 'type', self::EMAIL)
                ->assertAttribute(self::DUSK_EMAIL, 'wire:model.defer', self::EMAIL)
                ->assertVisible(self::SEND_CODE)
                ->assertAttribute(self::SEND_CODE, 'type', 'button')
                ->assertSeeIn(self::SEND_CODE, __('Enviar código de verificação'))
                ->click(self::SEND_CODE)
                ->waitForText(__('O campo e-mail é obrigatório.'), 1)
                ->type(self::EMAIL, Str::random(25))
                ->click(self::SEND_CODE)
                ->waitForText(__('O campo e-mail não contém um endereço de email válido.'), 1)
                ->type(self::EMAIL, 'viniciusbarizon@gmail.com')
                ->click(self::SEND_CODE)
                ->waitForText(__('Enviamos um código de verificação para o seu e-mail.'), 1);
        });
    }
}
