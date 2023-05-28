<?php

namespace Tests\Browser\JobSeeker\Create\VerificationCode;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VerifyTest extends DuskTestCase
{
    const DUSK_CODE = '@verification_code';

    const CODE = 'verification_code';

    const LENGTH = 6;

    const VERIFY_CODE = '@verify_code';

    public function testVerifyCode(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(__('Código'))
                ->assertVisible(self::DUSK_CODE)
                ->assertAttribute(self::DUSK_CODE, 'autocomplete', 'off')
                ->assertAttribute(self::DUSK_CODE, 'maxlength', self::LENGTH)
                ->assertAttribute(self::DUSK_CODE, 'minlength', self::LENGTH)
                ->assertAttribute(self::DUSK_CODE, 'name', self::CODE)
                ->assertAttribute(self::DUSK_CODE, 'required', true)
                ->assertAttribute(self::DUSK_CODE, 'type', 'text')
                ->assertAttribute(self::DUSK_CODE, 'wire:model.defer', self::CODE)
                ->assertVisible(self::VERIFY_CODE)
                ->assertAttribute(self::VERIFY_CODE, 'type', 'button')
                ->assertSeeIn(self::VERIFY_CODE, __('Verificar código'))
                ->click(self::VERIFY_CODE)
                ->waitForText(__('O campo Código é obrigatório.'), 1)
                ->type(self::CODE, Str::random(5))
                ->click(self::VERIFY_CODE)
                ->waitForText(__('O campo Código deve conter 6 caracteres.'), 1)
                ->type(self::CODE, Str::random(6))
                ->click(self::VERIFY_CODE)
                ->waitForText(__('Código inválido, por favor tente novamente.'), 1);
        });
    }
}
