<?php

namespace Tests\Browser\JobSeeker\VerificationCode;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VerifyTest extends DuskTestCase
{
    const DUSK_CODE = '@verification_code';

    const CODE = 'verification_code';

    const VERIFY_CODE = '@verify_code';

    public function testVerifyCode(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(__('Código'))
                ->assertVisible(self::DUSK_CODE)
                ->assertAttribute(self::DUSK_CODE, 'autocomplete', 'off')
                ->assertAttribute(self::DUSK_CODE, 'maxlength', 6)
                ->assertAttribute(self::DUSK_CODE, 'name', self::CODE)
                ->assertAttribute(self::DUSK_CODE, 'type', 'text')
                ->assertAttribute(self::DUSK_CODE, 'wire:model.defer', self::CODE)
                ->assertVisible(self::VERIFY_CODE)
                ->assertAttribute(self::VERIFY_CODE, 'type', 'button')
                ->assertSeeIn(self::VERIFY_CODE, __('Verificar código'))
                ->click(self::VERIFY_CODE)
                ->waitForText(__('O campo Código é obrigatório.'), 1)
                ->type(self::CODE, str()->random(5))
                ->click(self::VERIFY_CODE)
                ->waitForText(__('O campo Código deve conter 6 caracteres.'), 1)
                ->type(self::CODE, str()->random(6))
                ->click(self::VERIFY_CODE)
                ->waitForText(__('Código inválido, por favor tente novamente.'), 1)
                ->type('@email', fake()->email())
                ->click('@send_code')
                ->type(self::CODE, str()->random(6))
                ->click(self::VERIFY_CODE)
                ->waitForText(__('Código inválido, por favor tente novamente.'), 1);
        });
    }
}
