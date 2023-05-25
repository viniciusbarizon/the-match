<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IndexTest extends DuskTestCase
{
    const EMAIL = '@email';

    const LOGO = '@logo';

    const SEND_VERIFICATION_CODE = '@verification_code_send';

    public function testIndex(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertTitle(config('app.name').' - '.
                    __('Dê o match da sua pretensão salarial antes de iniciar o processo seletivo')
                )
                ->assertVisible(self::LOGO)
                ->assertAttribute(self::LOGO, 'alt', config('app.name'))
                ->assertAttributeContains(self::LOGO, 'src', '/resources/images/logo.png')
                ->assertSee(__('Preencha os dados abaixo, receba um link para compartilhar com as empresas, e saiba antes de iniciar o processo seletivo se o salário ofertado é compatível com a sua pretensão salarial.'))
                ->assertSee(__('Email'))
                ->assertVisible(self::EMAIL)
                ->assertAttribute(self::EMAIL, 'autocomplete', 'username')
                ->assertAttribute(self::EMAIL, 'name', 'email')
                ->assertAttribute(self::EMAIL, 'required', true)
                ->assertAttribute(self::EMAIL, 'type', 'email')
                ->assertAttribute(self::EMAIL, 'wire:model.lazy', 'email')
                ->assertVisible(self::SEND_VERIFICATION_CODE)
                ->assertAttribute(self::SEND_VERIFICATION_CODE, 'type', 'submit')
                ->assertSeeIn(self::SEND_VERIFICATION_CODE, __('Enviar código de verificação'))
                ->type('email', 'viniciusbarizon@gmail.com')
                ->click(self::SEND_VERIFICATION_CODE)
                ->waitForText(__('Um código de verificação foi enviado para o seu e-mail.'), 1);
        });
    }
}
