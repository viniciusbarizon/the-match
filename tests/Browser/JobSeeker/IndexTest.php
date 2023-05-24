<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IndexTest extends DuskTestCase
{
    public function testIndex(): void
    {
        $this->browse(function (Browser $browser) {
            $appName = config('app.name');
            $email = '@email';
            $logo = '@logo';
            $sendVerificationCode = '@send_verification_code';

            $browser->visit('/')
                ->assertTitle($appName . ' - ' .
                    __('Dê o match da sua pretensão salarial antes de iniciar o processo seletivo')
                )
                ->assertVisible($logo)
                ->assertAttribute($logo, 'alt', $appName)
                ->assertAttributeContains($logo, 'src', '/resources/images/logo.png')
                ->assertSee(__('Preencha os dados abaixo, receba um link para compartilhar com as empresas, e saiba antes de iniciar o processo seletivo se o salário ofertado é compatível com a sua pretensão salarial.'))
                ->assertSee(__('Email'))
                ->assertVisible($email)
                ->assertAttribute($email, 'autocomplete', 'username')
                ->assertAttribute($email, 'name', 'email')
                ->assertAttribute($email, 'required', true)
                ->assertAttribute($email, 'type', 'email')
                ->assertAttribute($email, 'wire:model.lazy', 'email')
                ->assertVisible($sendVerificationCode)
                ->assertAttribute($sendVerificationCode, 'type', 'submit')
                ->assertSeeIn($sendVerificationCode, __('Enviar código de verificação'))
                ->type('email', 'viniciusbarizon@gmail.com')
                ->click($sendVerificationCode)
                ->waitForText(__('Um código de verificação foi enviado para o seu e-mail.'), 1);
        });
    }
}
